<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    //
    public function create(){
        return view('sessions.create');
    }

    public function store(Request $request){
        $credentials = $this->validate($request,[
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);

        //   Auth::user() 返回的是一个对象，类似于 User::find(1) 这种，不过返回的是当前登录的用户的信息
        //  auth::user() 可以看做 [$user] 或 $user->id
        //  链接方法的重定向    辅助函数back返回前一个 URL
        // 有两种写法 redirect()->back();  或 redirect()->back()->withInput();
        if (Auth::attempt($credentials)){
            session()->flash('success','欢迎回来');
            return redirect()->route('users.show',[Auth::user()]);
        } else {
            session()->flash('danger','很抱歉，您的邮箱和密码不匹配');
            return redirect()->back()->withInput();
        }

    }



}
