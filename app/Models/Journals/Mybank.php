<?php

namespace App\Models\Journals;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mybank extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getSpedingMoneyAttribute()
    {
        return SpedingMoney::where('mybank_id', $this->id)->get()->count();
    }
}
