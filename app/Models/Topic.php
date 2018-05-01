<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';

    protected $fillable = [
      'name',
      'num_of_lessons'
    ];

    public function lessons(){
      return $this->belongsToMany('App\Models\Lesson', 'lesson_topics', 'topic_id', 'lesson_id');
    }
}
