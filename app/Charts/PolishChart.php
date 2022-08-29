<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class PolishChart
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
                ->addData([30, 80])
                ->setLabels(['All Polish', 'Polish Done']);
    }
}
