<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MeetingData;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Meeting extends Controller
{
  public function index()
  {
    return view('content.dashboard.dashboards-meeting');
  }
  public function meetingData(){
    $todayAverage = (int)MeetingData::todayAverage();
    $weeklyAverage = (int) MeetingData::weeklyAverage();
    $topMeetingDay = MeetingData::topMeetingDay();
    $lowestMeetingDay = MeetingData::lowestMeetingDay();

    // Space Used Count
    $spaceUsed = DB::table('meeting_data')->latest('created_at')->value('people_count');
    $totalCapacity = 25;
    $percentage = ($spaceUsed / $totalCapacity) * 100;

    // Weekly Meeting Usage Chart
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    $averageData = [];

    $startOfWeek = Carbon::now()->startOfWeek();
    $endOfWeek = Carbon::now()->endOfWeek();

    foreach($days as $day) {
      $average = MeetingData::where(DB::raw("DAYNAME(Date)"), $day)
      ->whereBetween('Date', [$startOfWeek, $endOfWeek])
      -> avg('people_count');

      $averageData[] = round($average);
    }

    //Today's Meeting Usage Chart

    $todayData = MeetingData::where('date', now()->toDateString())->get();
    $timeLabels = [];
    $peopleCounts = [];

    foreach ($todayData as $data) {
      $timeLabels[] = $data->Time;
      $peopleCounts[] = $data->people_count;
    }

    //Get Weekly Period Date
    $today = Carbon::now();
    $friday = $today->startOfWeek()->addDays(4);


        return view('content.dashboard.dashboards-meeting', [
          'todayAverage' => $todayAverage,
          'weeklyAverage' => $weeklyAverage,
          'topMeetingDay' => $topMeetingDay,
          'lowestMeetingDay' => $lowestMeetingDay,
          'spaceUsed' => $spaceUsed,
          'percentage' => $percentage,
          'startOfWeek' => $startOfWeek->format('d/m/Y'),
          'friday' => $endOfWeek->format('d/m/Y'),
          'weeklyMeetingUsage' => json_encode($averageData),
        ], compact('timeLabels', 'peopleCounts'));
  }
}
