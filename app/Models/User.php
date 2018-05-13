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
   protected $table = 'users';

  protected $fillable = [
      'name',
      'email',
      'username',
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
    return $this->hasMany('App\Models\Lesson');
  }

  public function parent(){
    return $this->hasMany('App\Models\User', 'parent_id');
  }

  public function children(){
    return $this->belongsTo('App\Models\User', 'parent_id');
  }

  public function medias(){
    return $this->hasMany('App\Models\Media');
  }

  public function favorLessons(){
    return $this->belongsToMany('App\Models\Lesson', 'favorite_lessons', 'user_id', 'lesson_id');
  }
}
