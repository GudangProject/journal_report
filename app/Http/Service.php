<?php

namespace app;

use Intervention\Image\Facades\Image;

class Service {
    public static function image($domain,$image)
    {
        $big = basename($domain.'/big/'.$image);
        $mid = basename($domain.'/big/'.$image);
        $thumb = basename($domain.'/big/'.$image);
        Image::make($big)->save(public_path('storage/posts/big/' . $big));
        Image::make($mid)->save(public_path('storage/posts/mid/' . $mid));
        Image::make($thumb)->save(public_path('storage/posts/thumb/' . $thumb));
    }
}
