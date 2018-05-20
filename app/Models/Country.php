<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $table = 'countries';

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function provinces(){
      return $this->hasMany('App\Models\Province');
    }
}
