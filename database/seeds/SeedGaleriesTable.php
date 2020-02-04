<?php

use Illuminate\Database\Seeder;

class SeedGaleriesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $images = scandir(storage_path('/app/public/galleries'));
        array_splice($images, 0, 2);
        for ($i = 0; $i<50; $i++){
            $image = $images[rand(0, count($images)-1)];
            \App\Gallery::create([
                'title' => $faker->company,
                'description' => $faker->text(200),
                'url' => '#',
                'image' => 'galleries/'.$image
            ]);
        }
    }
}
