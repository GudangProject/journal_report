<?php

namespace App\Models\Journals;

use App\Models\User;
use App\Models\Journals\Journal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function createBy(){
        return $this->belongsTo(User::class, 'created_by')->withTrashed();
    }

    public function journal(){
        return $this->belongsTo(Journal::class, 'journal_id')->withTrashed();
    }
}
