<?php

namespace App\Http\Controllers;

use App\Services\PartnerPostService;
use App\Services\CountryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerPostController extends Controller
{
    //
    public function index(){

        $user_id = Auth::user()->id;

        $own_posts = PartnerPostService::getAllByUser($user_id);
        $not_own_posts = PartnerPostService::getAllNotByUser($user_id);
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
        $topics = array();

        if( $input['favorite_topics'] != null ){
          $topics = explode(', ', $input['favorite_topics']);
        }

        $user_id = Auth::user()->id;
        $own_posts = PartnerPostService::searchPostByUser($user_id, $input);
        $not_own_posts = PartnerPostService::searchPostNotByUser($user_id, $input);
        $countries = CountryService::getAll();

        return view('community/group', compact('own_posts', 'not_own_posts', 'input', 'topics', 'countries'));
    }
}
