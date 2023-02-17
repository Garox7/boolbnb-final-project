<?php

use App\Visit;
use App\Property;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $property = Property::all('id')->all();

        for ($i=0; $i < 200; $i++) {
            Visit::create([
                'property_id' => $faker->randomElement($property)->id,
            ]);
        }
    }
}
