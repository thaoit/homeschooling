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
            'email' => 'nullable|unique:users|email',
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

    public static function validateUpdateAccount($input){

        $user_id = $input['id'];

        $rules = [
            'username' => "required_without:password|nullable|unique:users,username,$user_id|min:6",
            'password' => 'required_without:username|nullable|min:6|confirmed'
        ];

        $messages = [
            'min' => 'The :attribute must be at least :min',
            'unique' => 'The :attribute has existed, try others',
            'password.confirmed' => 'Password not matching'
        ];

        return Validator::make($input, $rules, $messages);
    }

    public static function validateUpdateGeneralProfile($input){

        $user_id = $input['id'];

        $rules = [
            'name' => 'required',
            'email' => "nullable|unique:users,email,$user_id|email"
        ];

        $messages = [
            'required' => 'The :attribute field is required',
            'email.unique' => 'Email has existed, try others'
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

    public static function updateAccount($input){

        $user = User::find( $input['id'] );

        if($user == null){
            return false;
        }

        $user->username = $input['username'];
        $user->password = bcrypt( $input['password'] );

        return $user->update();
    }

    public static function updateGeneralProfile($input){

        $user = User::find( $input['id'] );

        if($user == null){
            return false;
        }

        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->address = $input['address'];
        $user->other_info = $input['other_info'];

        return $user->save();
    }

    public static function delete($user_id){

        $user = User::find($user_id);

        if($user == null){
            return false;
        }

        return $user->delete();
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
