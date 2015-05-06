<?php
class AboutController extends \BaseController
{
    public function index()
    {
        $categories = Category::all();
        $data = compact('categories');
        return View::make('about.index', $data);
    }
}