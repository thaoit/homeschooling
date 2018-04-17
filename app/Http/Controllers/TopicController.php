<?php

namespace App\Http\Controllers;

use App\Models\Topic;

use Illuminate\Http\Request;

class TopicController extends Controller
{
    //

    public function search(Request $request){

        $name = $request->get('name');
        return Topic::where('name', 'like', "$name%")
              ->orderBy('name', 'desc')
              ->get();
    }
}
