<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $seeds=['DistrictSeeder'];
//        foreach($seeds as $seed){
//            $this->call($seed);
//        }
        $this->call(UpazillaSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
