<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\Answer;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //展示所有分类
        $category = QuestionCategory::all();
        return view('question.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data['category'] = QuestionCategory::all();
        $data['types'] = QuestionCategory::getTypeList();
        return view('question.create',compact('data'));
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
            'content'  => 'required|max:50',
            'category_id' => 'required',
            'type' => 'required',
        ]);
        $answer_id = 0;
        if($request->answer){
            $answer = Answer::create([
                'desc' => $request->answer
            ]);
            $answer_id = $answer->id;
        }
        //创建用户
        $question = Question::create([
            'content'  => $request->content,
            'category_id' => $request->category_id,
            'type' => $request->type,
            'param' => !empty($request->param) ? $request->param : '',
            'answer_id' =>  $answer_id,
        ]);
        $answer->question_id = $question->id;
        $answer->save();
        //重定向
        session()->flash('success','添加成功');
        //return redirect()->route('users.show',[$user]);
        return redirect()->route('question.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }


    public function categoryList($category_id)
    {   
        
        $data = Question::where('category_id',$category_id)->paginate(1);
        return view('question.categorylist',compact('data'));

    }
}
