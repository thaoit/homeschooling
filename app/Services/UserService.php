<?php
namespace App\Services;

use Config;
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

    public static function getChildFromParent($user_id){

        $child_users = User::where('role', Config::get('constants.role.child'))
                            ->where('parent_id', $user_id)
                            ->get();

        return $child_users;
    }
}
