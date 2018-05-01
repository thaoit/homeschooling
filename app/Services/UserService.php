<?php
namespace App\Services;

use App\Models\User;

class UserService{

    public static function getRole($user_id){

        $user =  User::find($user_id);

        if($user == null)
            return null;
        else
            return $user->role;
    }

    public static function getParentId($user_id){

        $user =  User::find($user_id);

        if($user == null)
            return null;
        else
            $user->select('parent_id')->get();
    }
}
