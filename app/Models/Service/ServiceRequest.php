<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $table        = 'permohonan_layanan';
    protected $primaryKey   = 'id_permohonan_layanan';
    protected $guarded      = [];

    public function getServiceDetail()
    {
        return $this->belongsTo(ServiceDetail::class, 'detail_layanan_id');
    }
}
