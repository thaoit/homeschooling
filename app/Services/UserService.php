<?php
namespace App\Services;

use Config;
use Validator;
use App\Models\User;

class UserService{

    public static function validate($input){

        $rules = [
            'username' => 'required|unique:users|min:6',
            'name' => 'required',
            'email' => 'unique: users|email',
            'password' => 'required|min:6|confirmed'
        ];

        $messages = [
            'required' => 'The :attribute field is required',
            'min' => 'The :attribute must be at least :min',
            'email.unique' => 'Email has existed, try others',
            'password.confirmed' => 'Password not matching'
        ];

        return Validator::make($input, $rules, $messages);
    }

    public static function storeChildByParent($object, $parent_id){

        $child = new User;
        $child->name = $object['name'];
        $child->username = $object['username'];
        $child->password = bcrypt($object['password']);
        $child->birthday = $object['birthday'];
        $child->gender = $object['gender'];
        $child->parent_id = $parent_id;
        $child->role = Config::get('constants.role.child');

        $child->save();

        return $child;
    }

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
