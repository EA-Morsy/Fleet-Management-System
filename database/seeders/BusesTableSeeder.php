<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Seat;
use App\Observers\BusObserver;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
      
            $values=[
                ["name"=>"Holiday Travel"],
                ["name"=>"Midnight Travel"],
                ["name"=>"Sunrise Travel"],
            ];
            Bus::insert($values);
            $bus=Bus::first();
            for($i=1 ;$i<= $bus->number_of_seats ; $i++)
            {
                Seat::create([
                    "bus_id"=>$bus->id,
                    "seat_number"=>'S'.$i
                ]);
            }
       
    }
}
