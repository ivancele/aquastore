<?php

namespace Database\Seeders;

use App\Models\Aquariums;
use Illuminate\Database\Seeder;

class AquariumsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    
    public function run()
    {
        $glass_types = ['typea', 'typeb', 'typec', 'typed']; //TODO: move this to it's own model and db and just create a relationship
        $shapes = ['sqaure', 'rectangle', 'circle', 'oval'];
        $has_water = [true, false];
        //Create a few aquariums: attr: 'glass_type' ,'size' ,'shape' ,'has_water' ,'max_capacity', 'temperature'

        for($i=5; $i < 200; $i+=25){
            Aquariums::create([
                'glass_type' => $glass_types[array_rand($glass_types)],
                'size'=> $i,
                'shape' => $shapes[array_rand($shapes)],
                'has_water' => $has_water[array_rand($has_water)],
                'max_capacity' => rand(1,50),
                'temperature' => rand(1,50)
            ]);
        }
    }
}
