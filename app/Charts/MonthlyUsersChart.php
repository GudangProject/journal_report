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
            $name[$i]    = $data[$i]['name'];
            $counter[$i] = $data[$i]['counter_layanan'] != 0 ? round(($data[$i]['counter_layanan']/$data[$i]['total_request']) * 100) : 0;
        }
        return $this->chart->donutChart()
                    ->addData($counter)
                    ->setLabels($name);
    }

    public function grafikTataUsaha($data){
        for($i = 0; $i < count($data); $i++){
            $name[$i]    = $data[$i]['name'];
            $counter[$i] = $data[$i]['counter_request'];
        }
        // dd($counter);

        return $this->chart->horizontalBarChart()
                    ->setTitle('Jumlah Pengajuan')
                    ->setColors(['#229999'])
                    ->addData('Pengajuan', $counter)
                    ->setXAxis($name);
    }

    public function grafikPendidikanAgama($data){
        for($i = 0; $i < count($data); $i++){
            $name[$i]    = $data[$i]['name'];
            $counter[$i] = $data[$i]['counter_request'];
        }
        // dd($counter);

        return $this->chart->horizontalBarChart()
                    ->setTitle('Jumlah Pengajuan')
                    ->setColors(['#8a4af3'])
                    ->addData('Pengajuan', $counter)
                    ->setXAxis($name);
    }

    public function grafikPendidikanMadrasah($data){
        for($i = 0; $i < count($data); $i++){
            $name[$i]    = $data[$i]['name'];
            $counter[$i] = $data[$i]['counter_request'];
        }
        // dd($counter);

        return $this->chart->horizontalBarChart()
                    ->setTitle('Jumlah Pengajuan')
                    ->setColors(['#4a5ff3'])
                    ->addData('Pengajuan', $counter)
                    ->setXAxis($name);
    }

    public function grafikHajidanumrah($data){
        for($i = 0; $i < count($data); $i++){
            $name[$i]    = $data[$i]['name'];
            $counter[$i] = $data[$i]['counter_request'];
        }
        // dd($counter);

        return $this->chart->horizontalBarChart()
                    ->setTitle('Jumlah Pengajuan')
                    ->setColors(['#f34a5f'])
                    ->addData('Pengajuan', $counter)
                    ->setXAxis($name);
    }

    public function grafikBimbinganMasyarakat($data){
        for($i = 0; $i < count($data); $i++){
            $name[$i]    = $data[$i]['name'];
            $counter[$i] = $data[$i]['counter_request'];
        }

        return $this->chart->horizontalBarChart()
                    ->setTitle('Jumlah Pengajuan')
                    ->setColors(['#894af3'])
                    ->addData('Pengajuan', $counter)
                    ->setXAxis($name);
    }

    public function grafikBimbinganMasyarakatKristen($data){
        for($i = 0; $i < count($data); $i++){
            $name[$i]    = $data[$i]['name'];
            $counter[$i] = $data[$i]['counter_request'];
        }

        return $this->chart->horizontalBarChart()
                    ->setTitle('Jumlah Pengajuan')
                    ->setColors(['#f3dd4a'])
                    ->addData('Pengajuan', $counter)
                    ->setXAxis($name);
    }

    public function grafikBimbinganMasyarakatKatolik($data){
        for($i = 0; $i < count($data); $i++){
            $name[$i]    = $data[$i]['name'];
            $counter[$i] = $data[$i]['counter_request'];
        }

        return $this->chart->horizontalBarChart()
                    ->setTitle('Jumlah Pengajuan')
                    ->setColors(['#4caf50'])
                    ->addData('Pengajuan', $counter)
                    ->setXAxis($name);
    }

    public function grafikBimbinganMasyarakatHindu($data){
        for($i = 0; $i < count($data); $i++){
            $name[$i]    = $data[$i]['name'];
            $counter[$i] = $data[$i]['counter_request'];
        }

        return $this->chart->horizontalBarChart()
                    ->setTitle('Jumlah Pengajuan')
                    ->setColors(['#ffc107'])
                    ->addData('Pengajuan', $counter)
                    ->setXAxis($name);
    }

    public function grafikBimbinganMasyarakatBudha($data){
        for($i = 0; $i < count($data); $i++){
            $name[$i]    = $data[$i]['name'];
            $counter[$i] = $data[$i]['counter_request'];
        }
        // dd($counter);
        return $this->chart->horizontalBarChart()
                    ->setTitle('Jumlah Pengajuan')
                    ->setColors(['#124324'])
                    ->addData('Pengajuan', $counter)
                    ->setXAxis($name);
    }
}
