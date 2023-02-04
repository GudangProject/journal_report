<?php

namespace App\Http\Livewire\Journals;

use App\Models\Journals\Mybank;
use Exception;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class MybankForm extends Component
{
    public $no_rekening, $bank, $owner;

    public function submit(){
        $same = Mybank::where('no_rekening', $this->no_rekening)->where('bank', $this->bank)->first();

        if($same){
            Alert::error('Gagal', 'Rekening dan bank sudah tersedia');
        }else{
            try {
                Mybank::create([
                    'no_rekening' => $this->no_rekening,
                    'bank' => $this->bank,
                    'owner' => $this->owner,
                ]);

                Alert::success('Berhasil', 'Nomor rekening berhasil ditambahkan');
                return redirect()->route('reports.finance');
                $this->dispatchBrowserEvent('closeModalMybank');

            } catch (Exception $error) {
                Alert::error('Gagal', $error->getMessage());
                return redirect()->route('reports.finance');
                $this->dispatchBrowserEvent('closeModalMybank');
            }
        }


    }

    public function render()
    {
        return view('livewire.journals.mybank-form');
    }
}
