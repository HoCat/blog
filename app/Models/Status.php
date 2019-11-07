<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Status extends Model
{
    protected $table = 'statuses';

    public $fillable = ['content'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
