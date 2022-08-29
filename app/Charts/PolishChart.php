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
                ->setMarkers(['#FF5722', '#E040FB'], 7, 10)
                ->setColors(['#FFC107', '#303F9F'])
                ->setFontColor('#ff6384')
                ->setLabels(['All Polish', 'Polish Done']);
    }
}
