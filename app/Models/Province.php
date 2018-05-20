<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    protected $table = 'provinces';

    protected $fillable = [
        'name',
        'country_id'
    ];

    public $timestamps = false;

    public function country(){
      return $this->belongsTo('App\Models\Country', 'country_id');
    }
}
