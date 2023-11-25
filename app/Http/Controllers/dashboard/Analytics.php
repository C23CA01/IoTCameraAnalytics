<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParkingData;
use Illuminate\Support\Facades\DB;

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
    $spaceUsed = DB::table('parking_data')->latest('created_at')->value('vehicle_count');
    $totalCapacity = 20;
    $percentage = ($spaceUsed / $totalCapacity) * 100;

        return view('content.dashboard.dashboards-analytics', [
          'todayAverage' => $todayAverage,
          'weeklyAverage' => $weeklyAverage,
          'topParkingDay' => $topParkingDay,
          'lowestParkingDay' => $lowestParkingDay,
          'spaceUsed' => $spaceUsed,
          'percentage' => $percentage,
        ]);
  }
}
