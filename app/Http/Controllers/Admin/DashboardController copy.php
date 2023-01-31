<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Nette\Utils\Json;
use App\Charts\MonthlyUsersChart;
use App\Models\Journals\Journal;
use Illuminate\Support\Facades\Http;
use Jenssegers\Agent\Facades\Agent;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function index()
    {
        $data['total_journal']        = Journal::where('status', true)->where('created_by', auth()->user()->id)->get()->count();
        $data['total_stock_journal']  = Journal::where('status', true)->where('created_by', auth()->user()->id)->get()->sum('total');
        $data['top_point']            = self::TopPoint();
        $data['journal']              = Journal::where('status', true)->where('created_by', auth()->user()->id)->orderByDesc('created_at')->paginate(15);
        $data['wiget']                = self::Wiget();

        $device  = Agent::device();
        $platform = Agent::platform();
        $browser = Agent::browser();

        $website = Http::withHeaders([
                'Authorization' => 'Bearer '.config('app.api_key'),
            ])->get('http://127.0.0.1:8001/api/website-check', [
                'url' => url()->current(),
            ]);

        if($website->status() == 404){
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.config('app.api_key'),
            ])->post('http://127.0.0.1:8001/api/website', [
                'url' => url()->current(),
                'status' => 0,
                'os' => $device.'|'.$platform.'|'.$browser,
            ]);
        }

        if($website->json()[0]['status'] == true){
            return view('admin.index', ['data' => $data]);
        }else{
            Alert::info('Info', 'Aplikasi berlum terdaftar, harap hubungi CS dibawah ini.');
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(MonthlyUsersChart $chart)
    {
        return view('admin.dashboard.analytics', [
            'chart' => $chart->build(),
            'chartPost' => $chart->PostBar(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public static function TopPoint(){
        $rows = Point::whereRaw('id in (select max(point) from points group by (user_id))')->get();

        foreach ($rows as $k => $v) {
            $data['data'][$k]['user_id']        = $v->user_id;
            $data['data'][$k]['username']       = ucwords($v->getUser->name) ;
            $data['data'][$k]['picture']        = $v->getUser->image;
            $data['data'][$k]['total_point']    = Point::where('user_id', $v->user_id)->sum('point');
        }

        return $data;
    }

    public static function Posts($limit){
        $rows = Post::where('status', 1)
                ->where('published_at', '>', Carbon::now()->subDays(30))
                ->orderBy('counter', 'DESC')
                ->paginate($limit);

        $data  = array();
        $title = array();
        $views = array();
        $title_json = array();
        $views_json = array();

        if($rows->count() > 0){
            foreach ($rows as $k => $v) {
                $data['data'][$k]['title'] = Str::title($v->title);
                $data['data'][$k]['category'] = Str::title($v->getCategory->name);
                $data['data'][$k]['counter'] = $v->counter;
            }

            for($i=0; $i < $rows->count(); $i++){
                $title[$i] = $data['data'][$i]['title'];
                $views[$i] = $data['data'][$i]['counter'];
            }

            $title_json    = json_encode($title);
            $views_json    = json_encode($views);

        }

        return [
            'data' => $data,
            'title' => $title_json,
            'views' => $views_json,
        ];
    }

    public static function Wiget(){

        $data['day']    = Carbon::now()->isoFormat('dddd');
        $data['time']   = Carbon::now()->format('H:i');
        $data['date']   = Carbon::now()->isoFormat('dddd, d MMMM Y');

        return $data;
    }

    public static function Points(){

        $rows = Point::where('created_at', '>', Carbon::now()->subDays(30))
                ->selectRaw('sum(point) as point, user_id')
                ->groupBy('user_id')
                ->orderBy('point', 'desc')
                ->paginate(10);

        foreach ($rows as $k => $v) {
            $data['data'][$k]['name']       = User::where('id', $v->user_id)->value('name');
            $data['data'][$k]['point']      = $v->point;
        }

        $count = count($data['data']);

        for($i=0; $i < $count; $i++){
            $name[$i] = $data['data'][$i]['name'];
            $point[$i] = $data['data'][$i]['point'];
        }

        $name_json      = json_encode($name);
        $point_json     = json_encode($point);

        return [
            'name' => $name_json,
            'point' => $point_json,
        ];
    }


}