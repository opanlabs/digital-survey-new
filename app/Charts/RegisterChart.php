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
            ->setColors(['#fff6eb', '#ffc700', '#F4A238'])
            ->addData([$total_register, $pending_register, $done_register])
            ->setLabels(['All Register', 'Pending', 'Done']);
    }
}
