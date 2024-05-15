<?php

namespace App\Charts;

use App\Models\BookingFacility;
use App\Models\Facility;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class BookingsByFaciltyChart
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
            ->setTitle('Total Bookings by Facility')
            ->setSubtitle('All transaction facility.')
            ->addData($data)
            ->setLabels($facility->pluck("nama_fasilitas")->toArray());
    }
}
