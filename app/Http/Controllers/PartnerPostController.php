<?php

namespace App\Http\Controllers;

use App\Services\PartnerPostService;
use Illuminate\Http\Request;

class PartnerPostController extends Controller
{
    //
    public function index(){

        $posts = PartnerPostService::getAll();

        return view('community/group', compact('posts'));
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

        $posts = PartnerPostService::search($input);

        //return redirect()->action('PartnerPostController@index');
        return view('community/group', compact('posts'));
    }
}
