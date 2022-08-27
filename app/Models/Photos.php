<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Services\DateServices;

class Photos extends Model
{
    use HasFactory;
    protected $table = 'photos';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getAdd()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getEdit()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getAvatar($value)
    {
        return 'https://ui-avatars.com/api/?name='.urlencode($value).'&color=305b90&background=e6eaf2';
    }

    public function getImageAttribute($value)
    {
        return '/storage/photos/' . $value;
    }

    public function getUrlAttribute()
    {
        $url = url('photo/'.$this->slug);
        return $url;
    }

    public function getDateAttribute()
    {
        return DateServices::dateHome($this->created_at);
    }

}
