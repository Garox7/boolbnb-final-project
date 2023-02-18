<?php

use App\User;
use App\Message;
use App\Property;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $propertyId = Property::all('id')->all();
        $userData = User::first();

        for ($i = 0; $i < 50 ; $i++) {
            Message::create([
                'property_id' => $faker->randomElement($propertyId)->id,
                'message' => $faker->paragraphs(rand(2, 6), true),
                'first_name' => $userData->first_name,
                'last_name' => $userData->last_name,
                'user_email' => $userData->email,
            ]);
        }
    }
}
