<?php

namespace App\Http\Controllers;

use App\Models\QuestionCategory;
use Illuminate\Http\Request;

class QuestionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加分类
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //验证用户信息
        $this->validate($request,[
            'name'  => 'required|max:50',
        ]);
        //创建用户
        $user = QuestionCategory::create([
            'name'  => $request->name,
        ]);

        //重定向
        session()->flash('success','添加成功！');
        //return redirect()->route('users.show',[$user]);
        return redirect()->route('question.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuestionCatrgory  $questionCatrgory
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionCatrgory $questionCatrgory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuestionCatrgory  $questionCatrgory
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionCatrgory $questionCatrgory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuestionCatrgory  $questionCatrgory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionCatrgory $questionCatrgory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuestionCatrgory  $questionCatrgory
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionCatrgory $questionCatrgory)
    {
        //
    }
}
