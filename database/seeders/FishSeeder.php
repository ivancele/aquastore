<?php

namespace Database\Seeders;

use App\Models\Fish;
use App\Models\Aquariums;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Builder;

class FishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fish::create([
            'aquarium_id' => Aquariums::where('size', '>', 75)->where('has_water', true)->whereDoesntHave('fish', function(Builder $query) { $query->where('common_name', 'Guppy'); })->inRandomOrder()->first()->id,
            'common_name' => 'Goldfish',
            'species' => 'Carassius auratus',
            'color' => 'orange',
            'fins' => 5, //ref: https://www.about-goldfish.com/goldfish-anatomy.html
            'weight' => 1500,
            'length' => 25,
            'avg_aquarium_temperature' => 18,
            'age' => (5*12),
            'diet' => 'Omnivore',
            'min_aquarium_size' =>189.27,
            'info_link' => 'https://www.thesprucepets.com/comet-goldfish-species-profile-5088723'
        ]);

        Fish::create([
            'aquarium_id' => Aquariums::where('size', '>', 75)->where('has_water', true)->whereDoesntHave('fish', function(Builder $query) { $query->where('common_name', 'Goldfish'); })->inRandomOrder()->first()->id,
            'common_name' => 'Guppy',
            'species' => 'Poecilia reticulata',
            'color' => 'yellow',
            'fins' => 3,
            'weight' => 200,
            'length' => 5.08,
            'avg_aquarium_temperature' => 23,
            'age' => (2*12),
            'diet' => 'Omnivore',
            'min_aquarium_size' => 37.85,
            'info_link' => 'https://www.thesprucepets.com/guppy-fish-species-profile-5078901'
        ]);

        Fish::create([
            'aquarium_id' => Aquariums::where('has_water', true)->inRandomOrder()->first()->id,
            'common_name' => 'Neon Tetra',
            'species' => 'Paracheirodon innesi',
            'color' => 'blue',
            'fins' => 2,
            'weight' => 220,
            'length' => 4,
            'avg_aquarium_temperature' => 26,
            'age' => (5*12),
            'diet' => 'Omnivore',
            'min_aquarium_size' => 40,
            'info_link' => 'https://www.fishkeepingworld.com/neon-tetra/'
        ]);

        Fish::create([
            'aquarium_id' => Aquariums::where('size', '>', 75)->where('has_water', true)->inRandomOrder()->first()->id,
            'common_name' => 'Betta Fish',
            'species' => 'Betta splendens',
            'color' => 'yellow',
            'fins' => 4,
            'weight' => 200,
            'length' => 7,
            'avg_aquarium_temperature' => 27,
            'age' => (2.5*12),
            'diet' => 'Carnivore',
            'min_aquarium_size' => 40,
            'info_link' => 'https://www.fishkeepingworld.com/betta-fish/'
        ]);
       
        
        Fish::create([
            'aquarium_id' => Aquariums::where('has_water', true)->inRandomOrder()->first()->id,
            'common_name' => 'Zebrafish',
            'species' => 'Danio rerio',
            'color' => 'Golden, Natural silver and blue striped, albino and glo',
            'fins' => 2,
            'weight' => 750,
            'length' => 5,
            'avg_aquarium_temperature' => 35,
            'age' => 10,
            'diet' => 'Omnivore',
            'min_aquarium_size' => 40,
            'info_link' => 'https://www.fishkeepingworld.com/zebra-danio/'
        ]);
    }
}
