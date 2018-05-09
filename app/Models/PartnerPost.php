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
        'max_no_of_partners',
        'favorite_topics',
        'address',
        'other_info',
        'user_id'
    ];

    public function user(){
      return $this->belongsTo('App\Models\User', 'user_id');
    }
}
