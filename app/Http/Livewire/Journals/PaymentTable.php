<?php

namespace App\Http\Livewire\Journals;

use App\Models\Journals\Journal;
use App\Models\Journals\JournalPoint;
use App\Models\Journals\Knowledge;
use App\Models\Journals\Naskah;
use App\Models\Journals\Payment;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentTable extends DataTableComponent
{

    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    public $selected_id, $status, $detailPayment;

    public function mount()
    {
        $this->detailPayment;
    }

    public function showModalDetail($id)
    {
        $this->selected_id = $id;
        $this->detailPayment = Payment::findOrFail($id);
        $this->dispatchBrowserEvent('openModalPayment');
    }


    public function statusModal($id, $status)
    {
        $this->selected_id = $id;
        $this->status = $status;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus()
    {

        $data = Payment::findOrFail($this->selected_id);
        $data->update(['status' => $this->status]);

        if ($data->status == true) {
            $countNaskah   = Naskah::where('payment_id', $data->id)->count();
            $journal       = Journal::findOrFail($data->journal_id);
            $journalStock  = $journal->total;

            if ($countNaskah > $journalStock) {

                Alert::error('Error', 'Slot tidak cucup, slot tersisa ' . $journalStock);
                return back()->withInput();
            } else {
                $updateStock   = $journalStock - $countNaskah;
                $currentStock  = $journal->update(['total' => $updateStock]);

                $point = new JournalPoint();
                $point->journal_id = $journal->id;
                $point->user_id = $journal->created_by;
                $point->point = $countNaskah * 2;
                $point->status = 1;
                $point->save();
            }
        }
        $this->dispatchBrowserEvent('closeModalStatus');
    }

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus()
    {
        $payment     = Payment::findOrFail($this->selected_id);
        $naskahCount = Naskah::where('payment_id', $this->selected_id)->get()->count();
        $journal     = Journal::findOrFail($payment->journal_id);
        $updateStock = $journal->update(['total' => $journal->total + $naskahCount]);

        if ($updateStock) {
            $payment->delete();
            Naskah::where('payment_id', $this->selected_id)->delete();
            JournalPoint::where('journal_id', $journal->id)->delete();
        }

        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function deleteSelectedModal()
    {
        $this->dispatchBrowserEvent('openModalDeleteSelected');
    }

    public function deleteSelected()
    {
        Payment::whereIn('id', $this->selectedKeys)->delete();
        $this->dispatchBrowserEvent('closeModalDeleteSelected');
    }

    public function columns(): array
    {
        return [
            Column::make('Judul', 'name')->sortable(),
            Column::make('Volume'),
            Column::make('Rumpun Ilmu'),
            Column::make('Nama'),
            Column::make('Judul Naskah'),
            Column::make('Tanggal Pembayaran'),
            Column::make('Nominal', 'price')
                ->sortable()
                ->asHtml()
                ->secondaryHeader(function () {
                    return view('admin.journals.payment.subtotal', ['subtotal' => 'price']);
                }),
            Column::make('Status'),
            Column::make('Aksi'),
        ];
    }

    // public array $bulkActions = [
    //     'deleteSelectedModal' => 'Delete',
    // ];

    public function filters(): array
    {
        if (auth()->user()->getRoleNames()[0] == 'pic') {
            $dataJournal = Journal::where('created_by', auth()->user()->id)->get();
        } else {
            $dataJournal = Journal::all();
        }

        $journal = array();
        foreach ($dataJournal as $k => $v) {
            $journal[$k]['id'] = $v->id;
            $journal[$k]['name'] = $v->name;
            $journal[$k]['volume'] = $v->volume;
        }
        // dd($journal);
        $data = collect($journal)->mapWithKeys(function ($name) {
            return [$name['id'] => $name['name']];
        })->toArray();

        // volume filter
        $volumeRows = Journal::where('created_by', auth()->user()->id)->selectRaw('count(id) as id_journal, volume')
            ->groupBy('volume')
            ->get();
        foreach ($volumeRows as $k => $v) {
            $vol[$k]['volume'] = $v->volume;
        }
        $dataVolume = collect($vol)->mapWithKeys(function ($a) {
            return [$a['volume'] => $a['volume']];
        })->toArray();

        return [
            'journal' => Filter::make('Nama Jurnal')
                ->select($data),
            'volume' => Filter::make('Volume')
                ->select($dataVolume),
            'status' => Filter::make('Status')
                ->select([
                    '0' => '--Semua--',
                    1 => 'LUNAS',
                    0 => 'PENDING',
                ]),
        ];
    }

    public function query(): Builder
    {
        $user = auth()->user();
        $naskah = Payment::where('journal_id', 157)->pluck('id');
        // dd($naskah);
        $data = Payment::query();
        if ($user->getRoleNames()[0] == 'author') {
            $data = $data->where('created_by', $user->id);
        }

        if ($user->getRoleNames()[0] == 'pic') {
            $journalId = Journal::where('created_by', $user->id)->pluck('id');
            $data = $data->when($this->getFilter('journal'), fn ($query, $journal) => $query->with('journal')->whereHas('journal', fn ($q) => $q->where('id', $journal)));
            $data = $data->when($this->getFilter('volume'), fn ($query, $volume) => $query->with('journal')->whereHas('journal', fn ($q) => $q->where('volume', $volume)));
            $data = $data->when($this->getFilter('status'), fn ($query, $status) => $query->where('status', $status));
            $data = $data->when($this->getFilter('search'), fn ($query, $term) => $query->where('payer_name', 'like', '%' . $term . '%'));
            $data = $data->whereIn('journal_id', $journalId)->orWhere('created_by', $user->id);
        }

        $data = $data->when($this->getFilter('search'), fn ($query, $term) => $query->where('payer_name', 'like', '%' . $term . '%'));
        $data = $data->when($this->getFilter('volume'), fn ($query, $volume) => $query->with('journal')->whereHas('journal', fn ($q) => $q->where('volume', $volume)));
        $data = $data->when($this->getFilter('journal'), fn ($query, $journal) => $query->with('journal')->whereHas('journal', fn ($q) => $q->where('id', $journal)));
        $data = $data->when($this->getFilter('status'), fn ($query, $status) => $query->where('status', $status));

        // dd($data);
        return $data;
    }

    public function rowView(): string
    {
        return 'admin.journals.payment.table';
    }

    public function modalsView(): string
    {
        return 'admin.journals.payment.modal';
    }
}
