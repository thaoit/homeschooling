<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonTopic extends Model
{
    //
    protected $table = 'lesson_topics';

    protected $fillable = [
      'lesson_id',
      'topic_id'
    ];
}
