<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class)->times(50)->make(); //times 生成数量
        //makeVisible 将模型实例隐藏的字段显示
        User::insert($users->makeVisible(['password','remember_token'])->toArray());
    }
}
