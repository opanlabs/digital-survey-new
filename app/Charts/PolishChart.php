<?php

namespace App\Charts;

use App\Models\RegisterClaim;
use Auth;

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
        $all_policies = RegisterClaim::select('no_polis')->where('id_branch', Auth::user()->id_branch )->get()->count();
        $done_policies = RegisterClaim::select('no_polis')->where('status','DONE')->where('id_branch', Auth::user()->id_branch )->get()->count();

        return $this->chart->pieChart()
                ->setTitle('')
                ->setSubtitle('')
                ->setColors(['#fff6eb', '#F4A238'])
                ->addData([$all_policies, $done_policies])
                ->setLabels(['All Policies', 'Policies Done']);
    }
}
