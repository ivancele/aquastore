<?php

namespace Database\Seeders;

use App\Models\Fish;
use App\Models\Aquariums;
use Illuminate\Database\Seeder;

class FishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // aquarium_id, common_name, species,color,fins, weight, length, avg_aquarium_temperature
        Fish::create([
            'aquarium_id' => Aquariums::inRandomOrder()->first()->id,
            'common_name' => 'Goldfish',
            'species' => 'Carassius auratus',
            'color' => 'orange',
            'fins' => 2,
            'weight' => '200',
            'length' => '5',
        ]);

        Fish::create([
            'aquarium_id' => Aquariums::inRandomOrder()->first()->id,
            'common_name' => 'Guppy',
            'species' => 'Poecilia reticulata',
            'color' => 'yellow',
            'fins' => 2,
            'weight' => '350',
            'length' => '4',
        ]);
    }
}
