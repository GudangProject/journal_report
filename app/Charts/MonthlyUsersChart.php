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

        return $this->chart->horizontalBarChart()
            ->addData('Views', json_decode($views))
            ->setXAxis(json_decode($title))
            ->setColors(['#303F9F'])
            ->setMarkers(['#FF5722', '#E040FB'], 7, 10);


    }
}
