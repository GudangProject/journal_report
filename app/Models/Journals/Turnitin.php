<?php

namespace App\Models\Journals;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Turnitin extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    // public function journal(){
    //     return $this->belongsTo(Journal::class, 'journal_id');
    // }
}
