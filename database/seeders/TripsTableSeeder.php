<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Station;
use App\Models\Trip;
use App\Models\Bus;
use App\Models\TripStations;
class TripsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $stations = Station::where('id','!=','2')->get();
        $trip = Trip::create([
            'from_station_id' => $stations->first()->id,
            'to_station_id' => $stations->last()->id,
            'bus_id' => 1
        ]
    );
    
        $stations->map(function ($station , $key) use ($trip) {
            TripStations::create([
                "trip_id" => $trip->id,
                'station_id' => $station->id,
                'order' => $key + 1
            ]);
        });
  
    }
}
