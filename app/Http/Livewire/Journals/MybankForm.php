<?php

namespace App\Http\Livewire\Journals;

use App\Models\Journals\Mybank;
use Exception;
use Livewire\Component;

class MybankForm extends Component
{
    public $no_rekening, $bank, $owner;

    public function submit(){
        try {
            Mybank::create([
                'no_rekening' => $this->no_rekening,
                'bank' => $this->bank,
                'owner' => $this->owner,
            ]);

            session()->flash('message', 'Nomor rekening berhasil ditambahkan');
            $this->dispatchBrowserEvent('closeModalMybank');

        } catch (Exception $error) {
            session()->flash('error', 'Data tidak boleh kosong');
            $this->dispatchBrowserEvent('closeModalMybank');
        }

    }

    public function render()
    {
        return view('livewire.journals.mybank-form');
    }
}
