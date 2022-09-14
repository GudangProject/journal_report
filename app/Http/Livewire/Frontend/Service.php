<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Service\Service as ServiceService;
use App\Models\Service\ServiceDetail;
use Livewire\Component;

class Service extends Component
{
    public
        $service_id,
        $services,
        $number_request,
        $service_list = null,
        $name,
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
}
