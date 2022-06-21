<?php

namespace App\Http\Livewire;

use App\Models\Integration;
use Exception;
use Livewire\Component;

class IntegrationIndex extends Component
{
    public $name, $domain, $api, $token, $category_id;
    public $data;
    public $search;
    public $showEditModal = false;

    public function create()
    {
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function store()
    {

        try{
            $save = new Integration();
            $save->name = $this->name;
            $save->domain = $this->domain;
            $save->api = $this->api;
            $save->token = $this->token;
            $save->category_id = $this->category_id;
            $save->save();

            session()->flash('message', $save->name.'. Berhasil ditambahkan!');
        }catch(Exception $e){
            session()->flash('message', $e->getMessage());
        }


        return redirect()->route('integrations.index');
    }
    public function edit(Integration $data)
    {
        $this->showEditModal = true;
        $this->dispatchBrowserEvent('show-form');

        $this->name = $data->name;
        $this->domain = $data->domain;
        $this->api = $data->api;
        $this->token = $data->token;
        $this->data = $data;
    }
    public function update()
    {
        $save = $this->data;
        $save->name = $this->name;
        $save->domain = $this->domain;
        $save->api = $this->api;
        $save->token = $this->token;
        $save->category_id = $this->category_id;
        $save->save();

        session()->flash('message', $this->name.'. Berhasil ditambahkan!');
        return redirect()->route('integrations.index');
    }

    public function render()
    {
        $row = Integration::search('name', $this->search)->get();
        return view('livewire.integration-index', ['row' => $row]);
    }
}
