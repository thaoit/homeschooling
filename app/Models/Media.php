<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    //
    protected $table = 'medias';

    protected $fillable = [
      'name',
      'origin_name',
      'url',
      'media_type',
      'user_id'
    ];

    public function lessons(){
      return $this->belongsToMany('App\Models\Lesson', 'references', 'media_id', 'lesson_id');
    }

    public function user(){
      return $this->belongsTo('App\Models\User', 'user_id');
    }
}
