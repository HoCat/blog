<?php

namespace App\Models;

use App\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Status;

class User extends Authenticatable
{   
    use Notifiable;
    //指定表名
    protected  $table = 'users';

    //允许指定字段入库
    protected $fillable = [
      'name','email','password'
    ];

    //隐藏危险字段
    protected $hidden = [
        'password','remember_token'
    ];

    protected $sayApiKey = "1f0f0a13833d9b4819af290f7452499a";

    static public function boot()
    {
        parent::boot();
        static::creating(function($user){
            $user->activation_token = str_random(30);
        });
    }

    //获取用户头像
    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/{$hash}?s={$size}";
    }


    //一对多 微博
    public function statuses(){
        return $this->hasMany(Status::class);
    }

    //展示微博列表
    public function feed()
    {
         return $this->statuses()->orderBy('created_at','desc');
    }

    //多对多关系  belongsToMany,第二个参数是关联表的名字，默认是模型+模型，这里使用了自定义
    public function followers()
    {
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');
    }
    //多对多关系 这里是user表对应user表
    public function followings()
    {
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');
    }
}
