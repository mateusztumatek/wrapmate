<?php

use Illuminate\Database\Seeder;

class SeedElementsTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $groups = \App\Category::all();
        $groups = $groups->groupBy('type');
        $images = scandir(storage_path('/app/public/default/example'));
        array_splice($images, 0, 2);
        $faker = \Faker\Factory::create();
        for ($i = 0; $i<3; $i++){
            $data = [
                'name' => $faker->name,
                'image' => 'default/example/'.$images[rand(0, count($images) -1 )],
                'image_pattern' => 'default/koszt.jpg',
                'description' => $faker->text(300)
            ];
            $selected_categories = collect();
            foreach ($groups as $key => $group){
                $selected_categories->push($group->random());
            }
            $element = \App\Element::create($data);
            $selected_categories = $selected_categories->map(function($item){
                return $item->id;
            });
            $element->categories()->attach($selected_categories);
        }
        $letters = ['A', 'B', 'C', 'D', 'E', 'F'];
        $prices = [20.00, 50.00, 100.00, 180.00, 140.00, 200.00];
        foreach (\App\Element::all() as $element){
            foreach ($letters as $l){
                $data = [
                    'sign' => $letters[rand(0, count($letters) - 1)],
                    'price' => $prices[rand(0, count($prices) - 1)],
                    'dimmensions' => 'Wymiary: '.rand(0, 100). ' x '.rand(100, 200)
                ];
                $element->signs()->create($data);
            }
        }
    }
}
