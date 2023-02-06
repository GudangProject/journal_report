<?php

namespace App\Models\Journals;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Naskah extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function journal()
    {
        return $this->belongsTo(Journal::class, 'journal_id')->withTrashed();
    }


}
