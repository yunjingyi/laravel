<?php
/**
 * Created by PhpStorm.
 * User: yunjingyi
 * Date: 15/5/5
 * Time: 下午3:29
 */

class Category extends \Eloquent {
    protected $table = 'categories';
    protected $fillable = [
        'name'
    ];

    public static $rules = [
        'name' => 'required',
    ];

    public function posts()
    {
        return $this->hasMany('Post');
    }
}