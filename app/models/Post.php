<?php
/**
 * Created by PhpStorm.
 * User: yunjingyi
 * Date: 15/5/5
 * Time: 下午2:57
 */

class Post extends \Eloquent {
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'content',
        'category_id',
    ];

    //砍掉所有自然语言的语法糖
    public static $rules = [ //表单校验用 store
        'title' => 'required',
        'content' => 'required',
        'category_id' => 'required|exists:categories,id',
    ];

    //n:1
    public function category()
    {
        return $this->belongsTo('Category');
    }

    //1:n
    public function comments()
    {
        return $this->hasMany('Comment');
    }
}