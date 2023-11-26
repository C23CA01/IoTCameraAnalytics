<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ParkingDataSeeder extends Seeder
{
    protected $table = 'parking_data';
    
    public function run(): void
    {
        $startDateTime = Carbon::parse('2023-11-24 08:00:00');
        $endDateTime = Carbon::parse('2023-11-24 16:00:00');
        $intervalMinutes = 10;

        $currentDateTime = clone $startDateTime;

        while ($currentDateTime <= $endDateTime) {
            $vehicleCount = rand(0, 20);

            DB::table('parking_data')->insert([
                'Date'=> $currentDateTime->toDateTimeString(),
                'Time' => $currentDateTime->toTimeString(),
                'vehicle_count' => $vehicleCount,
            ]);
            $currentDateTime->addMinutes($intervalMinutes);
        }
    }
}
