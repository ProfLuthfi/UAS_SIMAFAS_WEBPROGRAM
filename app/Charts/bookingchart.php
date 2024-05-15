<?php

namespace App\Charts;

use App\Models\BookingFacility;
use App\Models\Facility;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class bookingchart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $facility = Facility::all();
        $data = [];
        foreach ($facility as $key => $value) {
            $data[$key]= BookingFacility::where('id_facility', $value->id)->count();
        }

        return $this->chart->donutChart()
            ->setTitle('Top 3 scorers of the team.')
            ->setSubtitle('Season 2021.')
            ->addData('total', $data)
            ->setLabels($facility->pluck("nama_fasilitas")->toArray());
    }
}
