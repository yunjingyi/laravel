<?php

class RandomController extends \BaseController
{
    public function index()
    {
        $post = Post::all()->random(); //文章数量不会太多 无性能问题2015-05-06
        $categories = Category::all();

        $data = compact('post', 'categories');

        return View::make('posts.show', $data);
    }
}