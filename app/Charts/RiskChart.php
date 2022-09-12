<?php

namespace App\Charts;

use App\Models\RegisterSurvey;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class RiskChart
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
        $schedule_register = RegisterSurvey::where('status', 'SCHEDULE')->get()->count();
        $submit_register = RegisterSurvey::where('status', 'OPEN')->get()->count();

        return $this->chart->pieChart()
                ->setTitle('')
                ->setSubtitle('')
                ->setColors(['#fff6eb', '#ffc700', '#7339ea', '#F4A238'])
                ->addData([$total_register, $submit_register, $schedule_register, $done_register ])
                ->setLabels(['All Risk', 'Submitted', 'In-progress', 'Finished ']);
    }
}
