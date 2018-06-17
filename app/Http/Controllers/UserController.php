<?php

namespace App\Http\Controllers;

use Config;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function profile($username){

        $user = User::where('username', $username);

        if( count($user->get()) == 0 ){
            return view('welcome');
        }

        $user = $user->first();
        $child_users = UserService::getChildFromParent($user->id);

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

    public function storeChild(Request $request){

        $input = $request->input();
        $validator = UserService::validate($input);

        if($validator->fails()){

            return [
                'errors' => $validator->errors()->all()
            ];
        }
        else{

            $parent_id = Auth::user()->id;
            $child = UserService::storeChildByParent($input, $parent_id)->toArray();
            $child['age'] = UserService::getAge($child['birthday']);

            return [
                'success' => $child
            ];
        }
    }

    public function delete(Request $request){

        $input = $request->input();
        $result = false;

        if( isset($input['id']) ){

            $result = UserService::delete( $input['id'] );
        }

        if(!$result){

            return [
                'errors' => 'Error on deleting'
            ];
        }
    }

    public function changeAccount(Request $request){

        $input = $request->input();
        $validator = UserService::validateUpdateAccount($input);

        if($validator->fails()){

            return [
                'errors' => $validator->errors()->all()
            ];
        }
        else{

            $result = UserService::updateAccount($input);

            if($result){

                return [
                    'username' => $input['username']
                ];
            }
            else{

                return [
                    'errors' => 'Error on updating account'
                ];
            }
        }
    }

    public function updateGeneralProfile(Request $request){

        $input = $request->input();
        $validator = UserService::validateUpdateGeneralProfile($input);

        if($validator->fails()){
            return [
                'errors' => $validator->errors()->all()
            ];
        }
        else{

            $result = UserService::updateGeneralProfile($input);

            if(!$result){
              return [
                  'errors' => 'Error on deleting general profile'
              ];
            }
        }
    }
}
