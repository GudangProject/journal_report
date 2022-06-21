<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['url', 'images'];

    public function getCategory()
    {
        return $this->belongsTo(OfficeCategory::class, 'category_id');
    }

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

    public function getImagesAttribute()
    {
        return [
            'thumbnail' => '/storage/offices/thumb/' . $this->image,
            'medium' => '/storage/offices/mid/' . $this->image,
            'full' => '/storage/offices/big/' . $this->image,
        ];
    }

    public function getUrlAttribute()
    {
        $url = env('APP_URL').'/'.$this->getCategory->slug.'/'.$this->slug;
        return $url;
    }
}
