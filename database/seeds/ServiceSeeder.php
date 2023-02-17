<?php

use App\Service;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $services = [
            'Wi-Fi', 'Piscina', 'giardino', 'Cortile', 'Asciugacapelli', 'TV', 'Aria condizionata', 'Cucina', 'Riscaldamento centralizzato', 'Frigorifero', 'Forno', 'Fornelli', 'Sauna Privata', 'Cucina'
        ];

        foreach ($services as $service) {
            Service::create([
                'name' => $service,
                'description' => $faker->paragraphs(rand(2, 5), true),
            ]);
        };
    }
}
