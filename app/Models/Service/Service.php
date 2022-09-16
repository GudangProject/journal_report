<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Service\ServiceDetail;

class Service extends Model
{
    use HasFactory;

    protected $table        = 'layanan';
    protected $primaryKey   = 'id_layanan';
    protected $guarded      = [];

    public function serviceDetail(){
        return $this->hasMany(ServiceDetail::class, 'layanan_id');
    }

}
