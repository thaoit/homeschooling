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
      return $this->belongsToMany('App\Topic');
    }

    public function medias(){
      return $this->belongsToMany('App\Media');
    }

    public function user(){
      return $this->belongsTo('App\User', 'author_id');
    }

    public function outlines(){
      return $this->hasMany('App\Outline');
    }
}
