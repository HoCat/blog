<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\QuestionCategory;
use App\Models\Answer;

class Question extends Model
{
    //
    protected $table = 'question';

    protected $fillable = [
        'content','category_id','answer_id','param','type'
    ];


    public function category()
    {
    	return $this->hasOne(QuestionCategory::class);
    }

    public function answer()
    {
    	return $this->hasOne(Answer::class);
    }
}
