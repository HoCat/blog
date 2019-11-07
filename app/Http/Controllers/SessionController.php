<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{

    //展示登录页面
    public function create()
    {
        return view('session.create');
    }
    //创建会话 也就是登录方法
    public function store(Request $request){
        //验证信息
        $check = $this->validate($request,[
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);
        /**
         * 使用 email 字段的值在数据库中查找；
            如果用户被找到：
            - 先将传参的 password 值进行哈希加密，然后与数据库中 password 字段中已加密的密码进行匹配；
            - 如果匹配后两个值完全一致，会创建一个『会话』给通过认证的用户。会话在创建的同时，也会种下一个名为 laravel_session 的 HTTP Cookie，以此 Cookie 来记录用户登录状态，最终返回 true；
            - 如果匹配后两个值不一致，则返回 false；
        如果用户未找到，则返回 false。
         * Auth::attempt() 方法可接收两个参数，第一个参数为需要进行用户身份认证的数组，
         * 第二个参数为是否为用户开启『记住我』功能的布尔值。
         */
        //用户开启记住我
        if(Auth::attempt($check,$request->has('remember'))){
            if(Auth::user()->activation){
                session()->flash('success','欢迎回家!');
                $fallback = route('users.show',Auth::user());
                return redirect()->intended($fallback);
            }else{
                Auth::logout();
                session()->flash('warning','您的账号未激活！,请检查邮件中的注册邮件进行激活！');
                return redirect('/');
            }
           
        }else{
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
            return redirect()->back(); //返回上一页
        }
        return;

    }

    //销毁会话 退出登录方法
    public function destroy()
    {
        Auth::logout();
        session()->flash('success','您已成功退出！');
        return  redirect('login');
    }

}
