<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outline extends Model
{
    protected $table = "outlines";

    protected $fillable = [
      'name',
      'content',
      'lesson_id'
    ];

    public $timestamps = false;

    public function lesson(){
        return $this->belongsTo('App\Lesson', 'lesson_id');
    }
}
