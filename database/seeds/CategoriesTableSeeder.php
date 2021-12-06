<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 1; $i <= 10; $i++){
            $cate_name = $faker->sentence($nbWords = rand(1, 3), $variableNbWords = true);

            Category::create([
                'name' => ucfirst($cate_name),
                'slug' => Str::slug($cate_name),
                'description' => $faker->paragraph($nbSentences = rand(1,2), $variableNbSentences = true),
                'parent_id' => 0,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
