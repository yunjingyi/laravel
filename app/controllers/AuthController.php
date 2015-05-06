<?php

class AuthController extends \BaseController {

    public function index()
    {
        if(Auth::check())
        {
            return Redirect::route('home.index')->with('success', '登录成功');
        }
        return View::make('login.index');
    }

    public function process()
    {

        $validator = Validator::make(Input::all(), [ //校验输入
            'username' => 'required',
            'password' => 'required|between:3,32'
        ]);

        if($validator->fails()) //返回表单提交
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        //认证
        if(Auth::attempt(['username' => Input::get('username'), 'password' => Input::get('password')], Input::get('remember-me')))
        {
            return Redirect::route('home.index')->with('success', '登录成功');
        }

        return Redirect::back()->withInput()->with('error', '请检查输入');
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::route('home.index')->with('success', '已成功登出');
    }
}