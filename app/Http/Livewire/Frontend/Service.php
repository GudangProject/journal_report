<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Service\Service as ServiceService;
use App\Models\Service\ServiceDetail;
use App\Models\Service\ServiceRequest;
use Carbon\Carbon;
use Exception;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;
use Livewire\WithFileUploads;

class Service extends Component
{
    use WithFileUploads;

    public
        $number_request,
        $email,
        $name,
        $phone,
        $address,
        $document,
        $note;

    public
        $service_id,
        $services,
        $service_list = null,
        $requirements;

    public function mount(){
        $this->requirements;
        $this->services = ServiceService::all();
        $this->service_list;
    }

    public function render()
    {
        $rows = ServiceDetail::selectRaw('count(id_detail_layanan) as total_layanan, layanan_id')
                ->groupBy('layanan_id')
                ->get();

        $services = ServiceService::all();
        // foreach ($services as $k => $v) {
        //     $data[$k]['name'] = $v->nama_layanan;
        // }

        // dd($this->service_list);
        if($this->service_list != null){
            $require    = ServiceDetail::where('id_detail_layanan', $this->service_list)->first()->persyaratan_detail_layanan;
            $this->requirements = $require;
        }

        return view('livewire.frontend.service', [
            'data'          => ServiceDetail::all(),
            'requirements'  => $this->requirements,
        ]);
    }


    public function serviceRequest($id){
        $this->service_id = $id;
        $this->number_request = time();

        $this->dispatchBrowserEvent('openModalServiceRequest');
    }

    public function saveServiceRequest(){
        // dd($this->note);
        // dd($this->number_request.$this->service_list.$this->email.$this->email.$this->name.$this->service_list);
        // $this->validate([
        //     'document' => 'max:10024', // 10MB Max
        // ]);

        if($this->document != null){
            $filename = time().$this->document->getClientOriginalName();
            $this->document->storeAs('public/files/service/', $filename);
        }

        try {
            $save = new ServiceRequest();
            $save->nomor_permohonan_layanan = $this->number_request;
            $save->detail_layanan_id = $this->service_list;
            $save->email = $this->email;
            $save->nama = $this->name;
            $save->telepon = $this->phone;
            $save->alamat = $this->address;
            if($this->document){
                $save->file_persyaratan = $filename;
            }
            $save->catatan = $this->note;
            $save->status_permohonan = 'baru';
            $save->status_antrian = 'proses';
            $save->tanggal_antrian = Carbon::now();
            $save->permohonan_created_at = Carbon::now();
            $save->save();

            Alert::success('Berhasil', 'Permohonan berhasil dikirim');
            $this->dispatchBrowserEvent('closeModalServiceRequest');


        } catch (Exception $error) {
            dd($error->getMessage());
            Alert::error('Terjadi Kesalahan', $error->getMessage());
            $this->dispatchBrowserEvent('closeModalServiceRequest');
        }
    }
}
