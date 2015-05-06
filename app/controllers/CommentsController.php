<?php

class CommentsController extends \BaseController
{
    public function __construct()
    {
        $this->beforeFilter('csrf', ['on' => 'post']);
    }

    public function store()
    {
        $inputs = Input::all();

        $validation = Validator::make($inputs, Comment::$rules);

        if($validation->fails())
        {
            //回退到show页面，继续提交
            return Redirect::route('posts.show', $inputs['post_id'])->withErrors($validation)->withInput();
        }

        Comment::create($inputs);

        //模式沉淀比自定义页面干净舒服很多
        //核心是8h内熟悉框架和组件的能力(基于模式的熟悉度、rails) 2015-05-06
        return Redirect::route('posts.show', $inputs['post_id'])->with('success', '回复文章成功');
    }

}