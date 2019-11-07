<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class StaticPageController extends Controller
{
    //

    public function help()
    {
        return view('static_page/help');
    }

    public function about()
    {
        return view('static_page/about');
    }

    public function home()
    {      
        // $feed_items = [];
        // if(Auth::check()){
        //     $feed_items = Auth::user()->feed()->paginate(5); //分页
        // }

        return view('static_page/home');
    }
}
