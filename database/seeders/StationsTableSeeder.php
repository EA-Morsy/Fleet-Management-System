<?php

namespace Database\Seeders;

use App\Models\Station;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $values=[
            ["name"=>"Cairo"],
            ["name"=>"Giza"],
            ["name"=>"AlFayyum"],
            ["name"=>"AlMenia"],
            ["name"=>"Asyut"],
        ];
        
            Station::insert($values);
      
    }
}
