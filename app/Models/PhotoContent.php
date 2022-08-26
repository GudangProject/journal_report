<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoContent extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'photo_contents';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function getParent()
    {
        return $this->belongsTo(Photos::class, 'photo_id');
    }

    public function getImageAttribute($value)
    {
        return '/storage/photos/linkages/' . $value;
    }

}
