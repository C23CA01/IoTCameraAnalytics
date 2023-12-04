<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParkingData;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

    // Space Used Count
    $spaceUsed = DB::table('parking_data')->latest('created_at')->value('vehicle_count');
    $totalCapacity = 25;
    $percentage = ($spaceUsed / $totalCapacity) * 100;

    // Weekly Parking Usage Chart
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    $averageData = [];

    $startOfWeek = Carbon::now()->startOfWeek();
    $endOfWeek = Carbon::now()->endOfWeek();

    foreach($days as $day) {
      $average = ParkingData::where(DB::raw("DAYNAME(Date)"), $day)
      ->whereBetween('Date', [$startOfWeek, $endOfWeek])
      -> avg('vehicle_count');

      $averageData[] = round($average);
    }

    //Today's Parking Usage Chart

    $todayData = ParkingData::where('date', now()->toDateString())->get();
    $timeLabels = [];
    $vehicleCounts = [];

    foreach ($todayData as $data) {
      $timeLabels[] = $data->Time;
      $vehicleCounts[] = $data->vehicle_count;
    }


        return view('content.dashboard.dashboards-analytics', [
          'todayAverage' => $todayAverage,
          'weeklyAverage' => $weeklyAverage,
          'topParkingDay' => $topParkingDay,
          'lowestParkingDay' => $lowestParkingDay,
          'spaceUsed' => $spaceUsed,
          'percentage' => $percentage,
          'weeklyParkingUsage' => json_encode($averageData),
        ], compact('timeLabels', 'vehicleCounts'));
  }

}
