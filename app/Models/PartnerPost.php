<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerPost extends Model
{
    //
    protected $table = 'partner_posts';

    protected $fillable = [
        'age_from',
        'age_to',
        'gender',
        'favorite_topics',
        'country',
        'province',
        'other_info',
        'user_id'
    ];

    public function user(){
      return $this->belongsTo('App\Models\User', 'user_id');
    }
}
