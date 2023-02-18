<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('uploads');
        Storage::makeDirectory('uploads');
        $this->call(UserSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(SponsorshipSeeder::class);
        $this->call(PropertySeeder::class);
        $this->call(VisitSeeder::class);
        $this->call(PropertyImagesSeeder::class);
    }
}
