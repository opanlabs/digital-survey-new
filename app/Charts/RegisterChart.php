<?php

namespace App\Charts;

use App\Models\User;
use App\Models\RegisterSurvey;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class RegisterChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $total_register = RegisterSurvey::all()->count();
        $done_register = RegisterSurvey::where('status', 'DONE')->get()->count();
        $pending_register = RegisterSurvey::where('status', '!=', 'DONE')->get()->count();

        return $this->chart->pieChart()
            ->setTitle('')
            ->setSubtitle('')
            ->setColors(['#fff6eb', '#F4A238', '#ffc700'])
            ->addData([$total_register, $done_register, $pending_register])
            ->setLabels(['All Register', 'Done Register', 'Pending Register']);
    }
}
