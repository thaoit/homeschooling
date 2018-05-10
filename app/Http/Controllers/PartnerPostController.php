<?php

namespace App\Http\Controllers;

use App\Services\PartnerPostService;
use Illuminate\Http\Request;

class PartnerPostController extends Controller
{
    //
    public function index(){

        $own_posts = PartnerPostService::getAllByUser(1);
        $not_own_posts = PartnerPostService::getAllNotByUser(1);

        return view('community/group', compact('own_posts', 'not_own_posts'));
    }

    public function delete(Request $request){

        $input = $request->all();
        $result = false;

        if( isset($input['id']) ){

            $result = PartnerPostService::delete( $input['id'] );
        }

        return [
            'result' => $result
        ];
    }

    public function post(Request $request){

        $input = $request->input();
        // add current user id
        $input['user_id'] = 1;

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

        $own_posts = PartnerPostService::searchPostByUser(1, $input);
        $not_own_posts = PartnerPostService::searchPostNotByUser(1, $input);


        return view('community/group', compact('own_posts', 'not_own_posts', 'input', 'topics'));
    }
}
