<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageCategory extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function getParent()
    {
        return PageCategory::find($this->parent_id)?->name;
    }

    public function getAdd()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getEdit()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
