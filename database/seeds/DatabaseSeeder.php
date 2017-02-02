<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BetaCriterionsTableSeeder::class);
        $this->call(GamaCriterionsTableSeeder::class);
        $this->call(DeltaCriterionsTableSeeder::class);
        $this->call(EpsilonCriterionsTableSeeder::class);
        $this->call(StCriterionsTableSeeder::class);
        
    }
    
}
