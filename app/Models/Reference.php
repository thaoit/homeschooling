<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    //
    protected $table = "references";

    protected $fillable = [
      'lesson_id',
      'media_id'
    ];

    public $timestamps = false;
}
