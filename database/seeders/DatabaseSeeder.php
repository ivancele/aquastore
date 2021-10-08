<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Database\Seeders\FishSeeder;
use Database\Seeders\AquariumsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Aqua Store API",
            'email' => 'api@aquastore.app',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]); 
        //Create a test account

        User::factory(2)->create();

        $this->call([
            AquariumsSeeder::class,
            FishSeeder::class,
        ]);
    }
}
