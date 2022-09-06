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

    public function getAuthor($id)
    {
        $getUserPoint = Point::where('modul','photo')->where('post_id',$id)->get();
                $author = array();
                if(count($getUserPoint) > 0){
                    foreach($getUserPoint as $a=>$b){
                        $author[$a]['code']    = $b->user_type;
                        $author[$a]['type']    = config('app.user_type')[$b->user_type];
                        $getAuthor             = User::where('id', $b->user_id)->first();
                        $author[$a]['name']    = $getAuthor->name;
                        $author[$a]['image']   = '/storage/pictures/users/mid/'.$getAuthor->image;
                        $author[$a]['avatar']  = 'https://ui-avatars.com/api/?name='.urlencode($getAuthor->name).'&color=305b90&background=e6eaf2';
                        $author[$a]['url']     = env('APP_URL').'/author/'.$getAuthor->slug;
                    }
                }
        return $author;
    }

}
