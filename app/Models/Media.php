<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    //
    protected $table = 'medias';

    protected $fillable = [
      'name',
      'path',
      'media_type_id'
    ];

    public function media_type(){
      return $this->belongsTo('App\MediaType', 'media_type_id');
    }
}
