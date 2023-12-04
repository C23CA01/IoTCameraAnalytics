<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ParkingData extends Model
{
    protected $table = 'parking_data';
    protected $fillable = ['Date', 'Time', 'vehicle_count'];
    use HasFactory;

    public static function todayAverage()
    {
        return static::whereDate('Date', now()->toDateString())->avg(DB::raw('CAST(vehicle_count AS SIGNED)'));
    }

    public static function weeklyAverage() {
        return static::whereBetween('Date', [now()->startOfWeek(), now()->endOfWeek()])
            ->avg(DB::raw('CAST(vehicle_count AS SIGNED)'));
    }

    public static function topParkingDay(){
        return static::select(DB::raw('DAYNAME(date) as day'), DB::raw('ROUND(AVG(CAST(vehicle_count AS SIGNED))) as average'))
            ->whereBetween('Date', [now()->startOfWeek(), now()->endOfWeek()])
            ->groupBy('day')
            ->orderByDesc('average')
            ->orderByDesc('date')
            ->first();
    }

    public static function lowestParkingDay(){
        return static::select(DB::raw('DAYNAME(date) as day'), DB::raw('ROUND(AVG(CAST(vehicle_count AS SIGNED))) as average'))
            ->whereBetween('Date', [now()->startOfWeek(), now()->endOfWeek()])
            ->groupBy('day')
            ->orderBy('average')
            ->orderByDesc('date')
            ->first();
    }
}