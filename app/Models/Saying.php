<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saying extends Model
{
    protected $table = 'saying';

    protected $fillable = [
        'content','author'
    ];
}
