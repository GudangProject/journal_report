<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Officer extends Model
{
    use HasFactory;

    protected $table = 'officers';
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

    public function getImagesAttribute()
    {
        return [
            'thumbnail' => '/storage/offices/thumb/' . $this->image,
            'medium' => '/storage/offices/mid/' . $this->image,
            'full' => '/storage/offices/big/' . $this->image,
        ];
    }
}
