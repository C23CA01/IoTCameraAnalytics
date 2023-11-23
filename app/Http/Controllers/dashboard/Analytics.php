<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParkingData;

class Analytics extends Controller
{
  public function index()
  {
    return view('content.dashboard.dashboards-analytics');
  }

  public function parkingData(){
    $todayAverage = (int)ParkingData::todayAverage();
    $weeklyAverage = (int) ParkingData::weeklyAverage();
    $topParkingDay = ParkingData::topParkingDay();
    $lowestParkingDay = ParkingData::lowestParkingDay();

        return view('content.dashboard.dashboards-analytics', [
          'todayAverage' => $todayAverage,
          'weeklyAverage' => $weeklyAverage,
          'topParkingDay' => $topParkingDay,
          'lowestParkingDay' => $lowestParkingDay,
        ]);
  }
}
