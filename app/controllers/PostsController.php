<?php

class PostsController extends \BaseController
{
    public function __construct()
    {
        $this->beforeFilter('csrf', ['on' => 'post']);
    }

    //GET /posts
    public function index()
    {
        return Redirect::to('/');
    }

    //GET /posts/create
    public function create()
    {
        $categories = Category::all();

        $data = compact('categories');

        return View::make('posts.create', $data);
    }

    //POST  /posts
    public function store()
    {
        $inputs = Input::all();

        $validation = Validator::make($inputs, Post::$rules);

        if($validation->fails())
        {
            return Redirect::back()->withErrors($validation)->withInput();
        }

        Post::create($inputs); //异常处理在框架中

        return Redirect::route('home.index')->with('success', '新增文章成功');
    }

    //GET  /posts/{id} $post关联$comments, 写评论form在视图中  comments.store
    public function show($id)
    {
        $post = Post::find($id); //清晰的返回定义

        if(is_null($post))
        {
            return Redirect::route('home.index')->with('error', '找不到该文章');
        }

        $categories = Category::all();

        $data = compact('post', 'categories');

        return View::make('posts.show', $data);
    }

    //GET  /posts/{id}/edit
    public function edit($id)
    {
        $post = Post::find($id);
        if(is_null($post))
        {
            App::abort(404);
        }

        $categories = Category::all();

        $data = compact('post', 'categories');

        return View::make('posts.edit', $data);
    }

    //PUT /posts/{id}
    public function update($id)
    {
        $post = Post::findOrFail($id);

        $inputs = Input::all();

        $validation = Validator::make($inputs, Post::$rules); //更新、新建都走一遍所以放model, 模式沉淀

        if($validation->fails())
        {
            return Redirect::back()->withErrors($validation)->withInput();
        }

        $post->update($inputs);

        return Redirect::route('home.index')->with('success', '成功更新文章');

    }

    //DELETE /posts/{id}
    public function destroy($id)
    {
        Post::destroy($id);

        return Redirect::route('home.index')->with('success', '成功删除文章');
    }

}