<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Journals\Journal;
use App\Models\Journals\Naskah;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(DataController $data)
    {
        return view('layouts.home', [
            'data'  => Journal::orderByDesc('created_at')->get(),
            'naskah' => Naskah::orderByDesc('created_at')->get(),
        ]);
    }
}
