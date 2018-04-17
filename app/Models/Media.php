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
      'media_type'
    ];

    public function lessons(){
      return $this->belongsToMany('App\Lesson', 'references', 'media_id', 'lesson_id');
    }
}
