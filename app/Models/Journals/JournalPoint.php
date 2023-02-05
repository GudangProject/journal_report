<?php

namespace App\Models\Journals;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Journals\Journal;

class JournalPoint extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function journal()
    {
        return $this->belongsTo(Journal::class, 'journal_id')->withTrashed();
    }
}
