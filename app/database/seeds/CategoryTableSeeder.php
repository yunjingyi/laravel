<?php
/**
 * Created by PhpStorm.
 * User: yunjingyi
 * Date: 15/5/5
 * Time: 下午3:32
 */

//本质是什么都用文件记下来2015-05-05
class CategoryTableSeeder extends Seeder {
    public function run()
    {
        DB::table('categories')->truncate();

        $names = ['生活记事','心情写真','学习成果','杂项'];

        foreach($names as $index => $name)
        {
            Category::create([
                'name' => $name,
                'created_at' => \Carbon\Carbon::now()->addDays($index),
                'updated_at' => \Carbon\Carbon::now()->addDays($index),
            ]);
        }
    }
}