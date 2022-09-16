<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service\Service;
use App\Models\Service\ServiceRequest;

class ServiceDetail extends Model
{
    use HasFactory;

    protected $table = 'detail_layanan';
    protected $primaryKey = 'id_detail_layanan';
    protected $guarded = [];
    protected $appends = ['serviceName'];

    public function getService()
    {
        return $this->belongsTo(Service::class, 'layanan_id');
    }

    public function getServiceNameAttribute(){
        return $this->getService->nama_layanan;
    }


}
