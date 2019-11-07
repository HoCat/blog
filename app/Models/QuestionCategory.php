<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionCategory extends Model
{
    protected $table = 'question_category';

    protected $fillable = [
        'name'
    ];

    private static $typesList = [
		1 => [
    		'id'   => 1,
    		'name' => '选择',
		],
		2 => [
    		'id'   => 2,
    		'name' => '简答',
		],
		3 => [
    		'id'   => 3,
    		'name' => '填空',
		],
    ];

    static public function getTypeList($id=0)
    {	
    	if($id){
    		return self::$typesList[$id];
    	}
    	return self::$typesList;
    }


}
