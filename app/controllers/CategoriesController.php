<?php

class CategoriesController extends  \BaseController
{
    //写个curd 5min 2015-05-06
    public function __construct()
    {
        //配置性很强
        $this->beforeFilter('csrf', ['on' => 'post']);
    }

    //GET /categories
    public function index()
    {
        $categories = Category::paginate();

        $data = compact('categories');

        return View::make('categories.index', $data);
    }

    //GET /categories/create
    public function create()
    {
        $categories = Category::paginate(5);

        $data = compact('categories');

        return View::make('categories.create', $data);
    }

    //POST  /categories
    public function store()
    {
        $inputs = Input::all();

        $validation = Validator::make($inputs, Category::$rules);

        if($validation->fails())
        {
            return Redirect::back()->withErrors($validation)->withInput();
        }

        Category::create($inputs);

        return Redirect::route('categories.index')->with('success', '成功新增分类');
    }
    //GET /categories/{id}  获取关联$posts
    public function show($id)
    {
        $posts = Post::where('category_id', $id)->orderBy('created_at', 'desc')->paginate(5);

        $categories = Category::all();
        //代码敲多了意思就明了了
        $data = compact('posts', 'categories');

        return View::make('categories.show', $data);

    }

    //GET  /categories/{id}/edit
    public function edit($id)
    {
        $editing_category = Category::findOrFail($id);
        $categories = Category::all();

        $data = compact('editing_category', 'categories');

        return View::make('categories.edit', $data);
    }

    //PUT  /categories/{id}
    public function update($id)
    {
        $category = Category::findOrFail($id);

        $inputs = Input::all();

        $validation = Validator::make($inputs, Category::$rules);

        if($validation->fails())
        {
            return Redirect::back()->withErrors($validation)->withInput();
        }

        $category->update($inputs);

        return Redirect::route('categories.index')->with('success', '成功更新分类');
    }

    //DELETE /categories/{id} 删除类目把文章类目改成最近的类目

    public function destroy($id)
    {
        $category = Category::where('id', '!=', $id)->orderBy('id', 'desc')->first();
        $posts = Post::where('category_id', $id)->get();

        foreach($posts as $post)
        {
            $post->category_id = $category->id;
            $post->save();
        }

        Category::destroy($id);

        return Redirect::route('categories.index')->with('success', '成功删除分类');
    }
}