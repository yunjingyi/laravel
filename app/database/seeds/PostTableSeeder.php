<?php


use Faker\Factory as Faker;

class PostTableSeeder extends Seeder {
    //faker本质上是句子生成

    public function run()
    {
        $faker = Faker::create('zh_CN');

        DB::table('posts')->truncate();

        foreach(range(1, 50) as $index)
        {
            Post::create([
                'title'       => $faker->sentence(10),
                'content'     => $faker->paragraph(5),
                'category_id' => rand(1, 4),
                'created_at'  => \Carbon\Carbon::now()->addDays($index),
                'updated_at'  => \Carbon\Carbon::now()->addDays($index),
            ]);
        }
    }

}