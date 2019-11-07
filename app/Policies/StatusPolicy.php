<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Status;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatusPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    //删除时的策略
    public function destroy(User $user,Status $status)
    {
        return $user->id === $status->user_id; //当前微博是本人的才可以删除
    }
}