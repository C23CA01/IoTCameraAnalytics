<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MeetingDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDateTime = Carbon::parse('2023-12-05 08:00');
        $endDateTime = Carbon::parse('2023-12-05 16:00');
        $intervalMinutes = 10;

        $currentDateTime = clone $startDateTime;

        while ($currentDateTime <= $endDateTime) {
            $peopleCount = rand(0, 20);

            DB::table('meeting_data')->insert([
                'Date'=> $currentDateTime->toDateTimeString(),
                'Time' => $currentDateTime->toTimeString(),
                'people_count' => $peopleCount,
            ]);
            $currentDateTime->addMinutes($intervalMinutes);
        }
    }
}
