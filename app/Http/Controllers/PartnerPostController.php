<?php

namespace App\Http\Controllers;

use Config;
use App\Services\PartnerPostService;
use App\Services\CountryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerPostController extends Controller
{
    //
    public function index(){

        if( Auth::user()->role == Config::get('constants.role.child') ){
            return redirect()->action('HomeController@index');
        }

        $user_id = Auth::user()->id;

        $own_posts = PartnerPostService::getAllByUser($user_id, 0, Config::get('constants.max_loading_num'));
        $not_own_posts = PartnerPostService::getAllNotByUser($user_id, 0, Config::get('constants.min_loading_num'));
        $countries = CountryService::getAll();

        return view('community/group', compact('own_posts', 'not_own_posts', 'countries'));
    }

    public function delete(Request $request){

        $input = $request->all();
        $result = false;

        if( isset($input['id']) ){

            $user_id = Auth::user()->id;
            $author_id = PartnerPostService::getAuthorId( $input['id'] );

            if($user_id == $author_id){
                $result = PartnerPostService::delete( $input['id'] );
            }
        }

        return [
            'result' => $result
        ];
    }

    public function post(Request $request){

        $input = $request->input();

        // add current user id
        $input['user_id'] = Auth::user()->id;

        // save post
        PartnerPostService::store( $input );

        // return url for redirecting
        return action('PartnerPostController@index');
    }

    public function search(Request $request){

        $input = $request->input();

        $user_id = Auth::user()->id;

        $not_own_posts = PartnerPostService::searchPostNotByUser(
                            $user_id,
                            $input,
                            0,
                            Config::get('constants.max_loading_num')
                          );

        return [
            'not_own_posts' => $not_own_posts
        ];
    }

    public function loadMoreNotOwnPosts(Request $request){

        $input = $request->input();

        $user_id = Auth::user()->id;

        $not_own_posts = PartnerPostService::searchPostNotByUser(
                            $user_id,
                            $input,
                            $input['offset'],
                            Config::get('constants.max_loading_num')
                          );

        return [
            'not_own_posts' => $not_own_posts
        ];
    }

    public function loadMoreOwnPosts(Request $request){

        $input = $request->input();
        $user_id = Auth::user()->id;
        $own_posts = array();

        if( isset( $input['offset'] ) ){

            $own_posts = PartnerPostService::getAllByUser(
                            $user_id,
                            $input['offset'],
                            Config::get('constants.max_loading_num')
                        );
        }

        return [
            'own_posts' => $own_posts
        ];
    }
}
