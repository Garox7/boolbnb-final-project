<?php

use App\User;
use App\Service;
use App\Property;
use App\Sponsorship;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $faker = Faker::create('it_IT');
        $userId = User::all('id')->all();
        $serviceId = Service::all()->pluck('id');
        $serviceCount = count($serviceId);
        $sponsorshipId = Sponsorship::all()->pluck('id');

        for ($i = 0; $i < 20; $i++) {
            $property = Property::create([
                'name' => $faker->words(rand(2, 5), true),
                'description' => $faker->paragraphs(rand(2, 4), true),
                'user_id' => $faker->randomElement($userId)->id,
                'address' => $faker->address(),
                'latitude' => $faker->latitude(),
                'longitude' => $faker->longitude(),
                'bedroom_count' => rand(1, 20),
                'bed_count' => rand(1, 20),
                'bathroom_count' => rand(1, 20),
                'status' => rand(0, 1),
            ]);

            $property->services()->attach($faker->randomElements($serviceId, rand(0, ($serviceCount > 5) ? 5 : $serviceCount)));

            $property->sponsorships()->attach($faker->randomElement($sponsorshipId));
        }
    }
}
