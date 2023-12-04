<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MeetingData extends Model
{
    protected $table = 'meeting_data';
    protected $fillable = ['Date', 'Time', 'people_count'];
    use HasFactory;

    public static function todayAverage()
    {
        return static::whereDate('Date', now()->toDateString())->avg(DB::raw('CAST(people_count AS SIGNED)'));
    }

    public static function weeklyAverage() {
        return static::whereBetween('Date', [now()->startOfWeek(), now()->endOfWeek()])
            ->avg(DB::raw('CAST(people_count AS SIGNED)'));
    }

    public static function topMeetingDay(){
        return static::select(DB::raw('DAYNAME(date) as day'), DB::raw('ROUND(AVG(CAST(people_count AS SIGNED))) as average'))
            ->whereBetween('Date', [now()->startOfWeek(), now()->endOfWeek()])
            ->groupBy('day')
            ->orderByDesc('average')
            ->orderByDesc('date')
            ->first();
    }

    public static function lowestMeetingDay(){
        return static::select(DB::raw('DAYNAME(date) as day'), DB::raw('ROUND(AVG(CAST(people_count AS SIGNED))) as average'))
            ->whereBetween('Date', [now()->startOfWeek(), now()->endOfWeek()])
            ->groupBy('day')
            ->orderBy('average')
            ->orderByDesc('date')
            ->first();
    }
}
