<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function __construct(){
        //注册中间件 except：除了(黑名单) only:只有(白名单)
        $this->middleware('auth',[
            'except' => ['create','show','store','index','confirmEmail'] //除去这些不经过中间件过滤
        ]);

        // 只让未登录用户访问注册页面
        $this->middleware('guest',['only'=>'create']);
    }

    /*
     * 展示用户页
     */
    public function index()
    {   
        $users = User::where([])->paginate(10);
        return view('user.index',compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    /*
     * 展示个人信息
     */
    public function show(User $user)
    {
        //获取用户头像
        $user->gravatar();
        $statuses = $user->statuses()->orderBy('created_at','desc')->paginate(10);
        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return view('user.show',compact('user','statuses'));
    }

    /*
     * 创建用户验证信息
     */
    public function store(Request $request){
        //验证用户信息
        $this->validate($request,[
            'name'  => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6',
        ]);
        //创建用户
        $user = User::create([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        //发送邮箱验证
        $this->sendEmail($user);

        //重定向
        session()->flash('success','验证邮箱已发送到注册邮箱，请注意查收！');
        //return redirect()->route('users.show',[$user]);
        return redirect()->route('home');
    }



    public function edit(User $user){
        $this->authorize('update', $user);
        return view('user.edit',compact('user'));
    }

    public function update(User $user,Request $request){
        $this->authorize('update', $user);
        $this->validate($request,[
           'name' => 'required|max:50',
           'password' => 'required|confirmed|min:6'
        ]);

        $data = [];
        $data['name'] = $request->name;
        //如果提交密码 加密下
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        //更新信息
        $user->update($data);
        session()->flash('success','更新成功！');
        return redirect()->route('users.show',$user->id);

    }

    /*
     * 删除用户
     */
    public function destroy(User $user){
        $this->authorize('update',$user); //策略验证
        $user->delete();
        session()->flash('success','成功删除!');
        return back();
    }

    /*
     * 发送邮箱验证
     */
    public function sendEmail(User $user)
    {
        $view = 'email.confirm';
        $data = compact('user');
        $to   = '812707252@qq.com';
        $from = env('MAIL_USERNAME');
        $name = 'Lee';
        $subject = "恭喜你成为第888位用户,请点击激活！";
        Mail::send($view, $data, function ($message) use ($from,$to,$name, $subject) {
            $message->from($from,$name)->to($to)->subject($subject);
        });
    }

    public function confirmEmail($token){
        //firstOrFail()返回在数据库中找到的第一条记录。如果不存在匹配的模型，它会抛出一个error。
        $user = User::where('activation_token',$token)->firstOrFail();

        $user->activation = true; //把验证信息设为真
        $user->activation_token = null; //token设为NULL 已经验证过
        $user->save();

        Auth::login($user); //记录user信息
        session()->flash('success','恭喜！激活成功！'); //写入会话
        return redirect()->route('users.show',[$user]);
    }

}
