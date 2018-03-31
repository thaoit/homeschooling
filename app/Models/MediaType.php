<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaType extends Model
{
    //
    protected $table = 'media_types';

    protected $fillable = [
      'name',
      'description'
    ];

    public function medias(){
      return $this->hasMany('App\Media', 'media_type_id', 'id');
    }
}
