<?php

use App\Blog;
use Faker\Factory;
use Illuminate\Database\Seeder;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 22; $i++) {
            $content = $faker->paragraphs(10);
            array_walk($content, function (&$item) {
                $item = '<p>' . $item . '</p>';
            });

            $date = $faker->dateTimeBetween('-2 years');

            $blog = Blog::create([
                'title' => $faker->text(20),
                'image' => 'default.jpg',
                'summary' => implode(' ', $faker->sentences(2)),
                'content' => implode('', $content),
                'user_id' => $faker->numberBetWeen(1, 5),
                'created_at' => $date,
                'updated_at' => $date
            ]);

            $tags = [];
            $randomNumber = $faker->numberBetween(1, 3);
            for ($j = 1; $j <= $randomNumber; $j++) {
                array_push($tags, $j);
            }
            $blog->tags()->attach($tags);
        }
    }
}
