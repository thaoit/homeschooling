<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lessons';

    protected $fillable = [
      'title',
      'intro',
      'outline',
      'content',
      'status',
      'topics_id'
    ];

    public function topics(){
      return $this->belongsToMany('App\Topic');
    }
}
