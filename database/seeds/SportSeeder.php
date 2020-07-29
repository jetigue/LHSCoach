<?php

use App\Models\Sports\FallSport;
use App\Models\Sports\SpringSport;
use App\Models\Sports\WinterSport;
use Illuminate\Database\Seeder;

class SportSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(FallSport::class, 5)->create();
        factory(WinterSport::class, 5)->create();
        factory(SpringSport::class, 5)->create();

    }
}
