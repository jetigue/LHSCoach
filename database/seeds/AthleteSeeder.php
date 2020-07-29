<?php

use App\Models\Athlete;
use App\Models\Physical;
use Illuminate\Database\Seeder;

class AthleteSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Athlete::class, 100)->create()
            ->each(function ($athlete) {
                $athlete->physicals()->save(factory(Physical::class)
            ->make());
        });
    }
}
