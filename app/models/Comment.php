<?php

/**
 * Created by PhpStorm.
 * User: yunjingyi
 * Date: 15/5/5
 * Time: 下午3:03
 */

class Comment extends \Eloquent {
    protected $table = 'comments';
    protected $fillable = [
        'name',
        'email',
        'content',
        'post_id',
    ];

    public static $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'content' => 'required',
        'post_id' => 'required|exists:posts,id' //非外键约束，代码保证
    ];

    //n:1
    public function post()
    {
        return $this->belongsTo('Post');
    }
}