<?php

namespace App\Http\Controllers;

use Config;
use App\Models\Lesson;
use App\Services\LessonService;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    //

    public function index(){

        $lessons = LessonService::getAllByUser(1);

        return view('lesson/index', compact('lessons'));
    }

    public function view($id){

        $lesson = LessonService::getAllRelatingLesson($id);

        return view('lesson/view', compact('lesson'));
    }

    public function create(){

        return view('lesson/create');
    }

    public function store(Request $request){

        $input = $request->all();
        $lesson_id =  LessonService::store($input);

        return [
           'id' => $lesson_id
        ];
    }

    public function update(Request $request){

        $input = $request->all();
        $success = LessonService::update($input);

        return [
            'success' => $success
        ];
    }
}
