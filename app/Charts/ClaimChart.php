<?php

namespace App\Charts;


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
        return $this->chart->pieChart()
                ->setTitle('')
                ->setSubtitle('')
                ->setColors(['#fff6eb', '#F4A238', '#F4A238', '#F4A238', '#F4A238'])
                ->addData([50, 20, 10, 10, 10])
                ->setLabels(['All Claim', 'Claim submitted', 'Claim in-progress', 'Pending Claim', 'Finished Claim']);
    }
}
