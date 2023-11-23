<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AverageVehicleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $averageData = DB::table('parking_data')
            ->selectRaw('date, AVG(vehicle_count) as average_vehicle_count')
            ->groupBy('date')
            ->get();

        foreach ($averageData as $data) {
            DB::table('average_vehicle_data')->insert([
                'date' => $data->date,
                'average_vehicle_count' => $data->average_vehicle_count,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
