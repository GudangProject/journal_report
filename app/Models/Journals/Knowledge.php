<?php

namespace App\Models\Journals;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Journals\Journal;

class Knowledge extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function journal(){
        return $this->belongsTo(Journal::class, 'journal_id')->withTrashed();
    }

}
