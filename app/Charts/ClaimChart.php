<?php

namespace App\Charts;

use App\Models\RegisterClaim;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class ClaimChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {   
        $total_claim = RegisterClaim::all()->count();
        $done_claim = RegisterClaim::where('status', 'DONE')->get()->count();
        $schedule_claim = RegisterClaim::where('status', 'SCHEDULE')->get()->count();
        $submit_claim = RegisterClaim::where('status', 'OPEN')->get()->count();

        return $this->chart->pieChart()
                ->setTitle('')
                ->setSubtitle('')
                ->setColors(['#fff6eb', '#ffc700', '#7339ea', '#F4A238'])
                ->addData([$total_claim, $submit_claim, $schedule_claim, $done_claim ])
                ->setLabels(['All Claim', 'Submitted', 'In-progress', 'Finished']);
    }
}
