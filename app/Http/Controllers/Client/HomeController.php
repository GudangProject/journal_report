<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Journals\Journal;
use App\Models\Journals\Naskah;
use App\Models\Service;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Journal $journal, DataController $data)
    {
        $journal->visitsCounter()->increment();

        $day = Visitor::whereDate('created_at', '>=', Carbon::today()->subDays(7))->get()->count();

        // data pengunjung
        $visitor = array([
            'day' => Visitor::whereDate('created_at', Carbon::today())->get()->count(),
            'week' => Visitor::whereDate('created_at', '>=', Carbon::today()->subDays(7))->get()->count(),
            'month' => Visitor::whereDate('created_at', '>=', Carbon::today()->subMonth(1))->get()->count(),
            'year' => Visitor::whereDate('created_at', '>=', Carbon::today()->subMonth(12))->get()->count(),
            'total' => Visitor::all()->count(),
        ]);
        return view('layouts.home', [
            'data'  => Journal::orderByDesc('created_at')->get(),
            'naskah' => Naskah::orderByDesc('created_at')->get(),
            'visitor' => $visitor
        ]);
    }
}
