<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonController extends Controller
{
    function __construct()
    {
        //下发名言
        $say = getSaying();
        if($say['code'] == 200){

        }
    }
}
