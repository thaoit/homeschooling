<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name',
      'email',
      'password',
      'birthday',
      'gender',
      'address',
      'other_info',
      'parent_id',
      'role'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'password', 'remember_token',
  ];

  public function lessons(){
    return $this->hasMany('App\Lesson');
  }

  public function parent(){
    return $this->hasMany('App\User', 'parent_id');
  }

  public function children(){
    return $this->belongsTo('App\User', 'parent_id');
  }
}
