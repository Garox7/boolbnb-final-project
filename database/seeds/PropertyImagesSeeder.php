<?php

use App\Property;
use App\PropertyImages;
use Illuminate\Http\File;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Faker\Generator as Faker;

class PropertyImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $propertyId = Property::all('id')->all();
        $imagesCount = 85;

        for ($i = 0; $i < $imagesCount; $i++) {

            $n = rand(1, $imagesCount);
            $content = new File(__DIR__ . '/../../storage/app/random_img/picsum' . $n . '.jpg');
            $img_path = Storage::put('uploads', $content);

            PropertyImages::create([
                'property_id' => $faker->randomElement($propertyId)->id,
                'image' => $img_path,
            ]);
        }

        for ($i = 0; $i < ($imagesCount - count($propertyId)); $i++) {
            $n = rand(1, $imagesCount);
            $content = new File(__DIR__ . '/../../storage/app/random_img/picsum' . $n . '.jpg');
            $img_path = Storage::put('uploads', $content);

            PropertyImages::create([
                'property_id' => $faker->randomElement($propertyId)->id,
                'image' => $img_path,
            ]);
        }
    }
}
