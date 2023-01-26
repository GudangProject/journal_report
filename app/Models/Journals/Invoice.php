<?php

namespace App\Models\Journals;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getPayment(){
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}
