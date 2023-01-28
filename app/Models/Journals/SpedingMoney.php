<?php

namespace App\Models\Journals;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Journals\Mybank;

class SpedingMoney extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function usedBy(){
        return $this->belongsTo(User::class, 'used_by');
    }

    public function mybank(){
        return $this->belongsTo(Mybank::class, 'mybank_id');
    }

}
