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
                ->setColors(['#fff6eb', '#F4A238'])
                ->addData([10, 90])
                ->setLabels(['All Claim', 'Claim Done']);
    }
}
