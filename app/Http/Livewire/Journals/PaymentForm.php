<?php

namespace App\Http\Livewire\Journals;

use Livewire\Component;
use App\Models\Journals\Journal;

class PaymentForm extends Component
{
    public $journals;
    public $journal_id, $volume;

    public function mount(){
        $this->journals;
    }

    public function render()
    {
        if($this->journal_id){
            $journalName = Journal::findOrFail($this->journal_id);
            $volume = Journal::where('name', $journalName->name)->get();
        }

        return view('livewire.journals.payment-form', [
            'volume' => $volume
        ]);
    }
}
