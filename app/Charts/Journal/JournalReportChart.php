<?php

namespace App\Charts\Journal;

use App\Models\Journals\Journal;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class JournalReportChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        return $this->chart->lineChart()
            ->setTitle('Grafik Jurnal '.date('Y'))
            ->setSubtitle('Data jurnal ditambahkan.')
            ->addData('Jurnal', [70, 29, 77, 28, 55, 45, 70, 29, 77, 28, 55, 45,])
            ->setColors(['#3f6da1'])
            ->setXAxis(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']);
    }
}
