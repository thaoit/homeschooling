<?php

namespace App\Http\Controllers;

use Config;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function profile($username){

        $user = User::where('username', $username);

        if( count($user->get()) == 0 ){
            return view('welcome');
        }

        $user = $user->first();

        switch ($user->role) {

          case Config::get('constants.role.admin'):
            return view('user/profile/admin', compact('user'));

          case Config::get('constants.role.parent'):
            $child_users = UserService::getChildFromParent($user->id);
            return view('user/profile/parent', compact('user', 'child_users'));

          case Config::get('constants.role.child'):
            return view('user/profile/child', compact('user'));
        }
    }
}
