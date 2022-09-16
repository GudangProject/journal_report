<?php

namespace App\Charts;

use App\Http\Controllers\Admin\DashboardController;
use App\Models\Point;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $points_total   = DashboardController::Points()['point'];
        $points_name    = DashboardController::Points()['name'];
        // dd($points_total);
        return $this->chart->horizontalBarChart()
            ->addData( 'Point', json_decode($points_total))
            ->setColors(['#7569f0'])
            ->setXAxis(
                json_decode($points_name)
            );


    }

    public function PostBar()
    {
        $title  = DashboardController::Posts(10)['title'];
        $views  = DashboardController::Posts(10)['views'];

        if(!empty($title) && !empty($views)){
            return $this->chart->horizontalBarChart()
                ->addData('Views', json_decode($views))
                ->setXAxis(json_decode($title))
                ->setColors(['#303F9F'])
                ->setMarkers(['#FF5722', '#E040FB'], 7, 10);

        }else{
            return [];
        }


    }

    public function dataRequestServiceDonut($data){

        for($i = 0; $i < count($data); $i++){
            $name[$i]   = $data[$i]['name'];
            $counter[$i] = $data[$i]['counter_layanan'] != 0 ? round(($data[$i]['counter_layanan']/$data[$i]['total_request']) * 100) : 0;
        }
        // dd($counter);
        // $name = $data-
        return $this->chart->donutChart()
                    ->addData($counter)
                    ->setLabels($name);
    }
}
