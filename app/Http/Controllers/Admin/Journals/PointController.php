<?php

namespace App\Http\Controllers\Admin\Journals;

use App\Http\Controllers\Controller;
use App\Models\Journals\Journal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Journals\JournalPoint as Point;
use Illuminate\Support\Facades\DB;

class PointController extends Controller
{

    public function index(Request $request)
    {
        $month = $request->get('month', date('m'));
        $year = $request->get('year', date('Y'));

        $check = Point::latest()->first();
        // dd($check);

        if($check)
        {
            $minyears  = Carbon::createFromFormat('Y-m-d H:i:s', Point::min('created_at'))->year;
            $maxyears  = Carbon::createFromFormat('Y-m-d H:i:s', Point::max('created_at'))->year;

            $data['date']['month'] = array(1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember');
            for($i=$minyears;$i<=$maxyears;$i++){
                $data['date']['years'][$i] = $i;
            }

        }


        $row = Point::select(DB::raw('user_id, sum(point) as totalPoint, count(journal_id) as totalJournal'))->where('point','>',0);

        $row = $row->whereMonth('created_at',$month)->whereYear('created_at',$year);

        $points = $row->groupBy('user_id')
                        ->orderBy('totalPoint', 'desc')
                        ->get();

        // dd($points);

        foreach ($points as $k => $v) {
            $row_view = Point::whereMonth('created_at',$month)
                    ->whereYear('created_at',$year)
                    ->where('user_id',$v->user_id)
                    ->get();

            $post_id = array();
            foreach($row_view as $a=>$b){
                $post_id[] = $b->post_id;
            }

            // $view_post = (isset($post_id)) ? Journal::whereIn('id', $post_id)->sum('counter') : 0;

            $data['data'][$k]['name']           = $v->user->name;
            $data['data'][$k]['total_point']    = number_format($v->totalPoint);
            $data['data'][$k]['total_journal']     = number_format($v->totalJournal);
        }

        $data['date_now'] = [
            'month' => $month,
            'year' => $year,
        ];
        // dd($data);
        return view('admin.journals.points.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
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
}
