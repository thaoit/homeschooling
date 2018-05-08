<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lessons';

    protected $fillable = [
      'title',
      'intro',
      'status',
      'no_of_love',
      'author_id'
    ];

    public function topics(){
      return $this->belongsToMany('App\Models\Topic', 'lesson_topics');
    }

    public function medias(){
      return $this->belongsToMany('App\Models\Media', 'references', 'lesson_id', 'media_id');
    }

    public function user(){
      return $this->belongsTo('App\Models\User', 'author_id');
    }

    public function outlines(){
      return $this->hasMany('App\Models\Outline');
    }

    public function favorByUsers(){
      return $this->belongsToMany('App\Models\User', 'favorite_lessons', 'lesson_id', 'user_id');
    }
}
