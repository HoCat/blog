<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\New;

class NewController extends Controller
{
    
	//推荐
	public function recommend()
	{
		$data = New::where('is_recommend')->get();
		foreach($data as $k => $v){
			$v->created = $v->created_at->diffForHumans(); //转换时间
			$data[$k] = $v;
		}
		return $data;
	}

	public function list(){
		$data = New::all();
		foreach($data as $k => $v){
			$v->created = $v->created_at->diffForHumans(); //转换时间
			$data[$k] = $v;
		}
		return $data;
	}

	public function show($id)
	{
		$info = New::findOrFail($id);
		return $info;
	}


}
