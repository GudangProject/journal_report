<?php

namespace App\Models\Journals;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Journals\Knowledge;

class Journal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'journals';
    protected $keyPrimary = 'id';
    protected $guarded = [];

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function knowledge(){
        return $this->belongsTo(Knowledge::class, 'knowledge_id');
    }

    public function visitsCounter()
    {
        return visits($this);
    }

    public function visits()
    {
        return visits($this)->relation();
    }

}
