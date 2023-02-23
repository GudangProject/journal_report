<?php

use App\Models\Websetting;

function website(){
    $data = Websetting::latest()->first();

    return $data;
}
