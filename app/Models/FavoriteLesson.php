<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteLesson extends Model
{
    //
    protected $table = 'favorite_lessons';

    protected $fillable = [
        'lesson_id',
        'user_id'
    ];

    protected $primaryKey = [
        'lesson_id',
        'user_id'
    ];

    public $incrementing = false;
    public $timestamps = false;
}
