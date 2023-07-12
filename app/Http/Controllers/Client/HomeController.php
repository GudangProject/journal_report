<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Journals\Journal;
use App\Models\Journals\Naskah;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Journal $journal, DataController $data)
    {
        $journal->visitsCounter()->increment();

        // data pengunjung
        $visitor = array([
            'day' => visits($journal)->period('day')->count(),
            'week' => visits($journal)->period('week')->count(),
            'month' => visits($journal)->period('month')->count(),
        ]);

        return view('layouts.home', [
            'data'  => Journal::orderByDesc('created_at')->get(),
            'naskah' => Naskah::orderByDesc('created_at')->get(),
            'visitor' => $visitor
        ]);
    }
}
