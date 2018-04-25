<?php

namespace App\Http\Controllers;

use Config;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    //

    public function create(){

        return view('lesson/create');
    }

    public function store(Request $request){

        $input = $request->all();

        $lesson = new Lesson;

        $lesson->title = $input['title'];
        $lesson->intro = $input['intro'];
        $lesson->author_id = $input['author_id'];
        $lesson->status = ($input['is_publish'] == 'true') ? Config::get('constants.lesson_status.publish'): Config::get('constants.lesson_status.draft');

        // save and return id
        $lesson->save();

        return [
           'id' => $lesson->id
        ];
    }

    public function update(Request $request){

        $input = $request->all();
        $lesson = Lesson::find($input['id']);
        $success = false;

        if($lesson != null){

          $lesson->title = $input['title'];
          $lesson->intro = $input['intro'];
          $lesson->author_id = $input['author_id'];
          $lesson->status = ($input['is_publish'] == 'true') ? Config::get('constants.lesson_status.publish'): Config::get('constants.lesson_status.draft');

          $lesson->save();
          $success = true;
        }

        return [
            'success' => $success
        ];
    }
}
