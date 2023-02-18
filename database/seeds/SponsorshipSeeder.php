<?php

use App\Sponsorship;
use Illuminate\Database\Seeder;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = [
            1, 2, 3
        ];

        foreach ($levels as $level) {
            Sponsorship::create([
                'sponsor_level' => $level,
            ]);
        }
    }
}
