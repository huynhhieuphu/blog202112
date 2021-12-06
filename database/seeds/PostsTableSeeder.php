<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Post;
use App\Http\Models\Tag;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 1; $i <= 20; $i++ ){
            $title = $faker->sentence($nbWords = 6, $variableNbWords = true);

            $post = Post::create([
                'title' => ucfirst($title),
                'slug' => Str::slug($title),
                'category_id' => rand(1, 10),
                'author_id' => 1,
                'image' => null,
                'summary' => $faker->paragraph($nbSentences = 6, $variableNbSentences = true),
                'content' => $faker->text($maxNbChars = 3600),
                'published' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            
            $tags = $faker->words($nb = rand(1, 3), $asText = false);         
            
            $tag_ids = [];
            foreach($tags as $tag){
                $tag_db = Tag::firstOrCreate(
                    ['name' => trim($tag)],
                    ['slug' => Str::slug(trim($tag)), 'created_at' => date('Y-m-d H:i:s')]
                );
                $tag_ids[] = $tag_db->id;
            }
            
            $post->tags()->attach($tag_ids);
        }
    }
}
