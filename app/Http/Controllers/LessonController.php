<?php

namespace App\Http\Controllers;

use Config;
use App\Models\Lesson;
use App\Services\LessonService;
use App\Services\TopicService;
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

    public function edit($id){

        $lesson = LessonService::getAllRelatingLesson($id);

        return view('lesson/edit', compact('lesson'));
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

    public function delete($id){

        LessonService::delete($id);
        return redirect()->action('LessonController@index');
    }

    public function resources(){

        $lessons = LessonService::getAllInPublic();
        $topics = TopicService::getAllInOrder('asc');

        return view('community/resource', compact('lessons', 'topics'));
    }

    public function findLessonsByTopics(Request $request){

        $input = $request->all();
        $lessons = array();

        // check whether passing parameter about topics
        if( isset( $input['topics'] ) ){

          $topics = $input['topics'];
          $lessons = LessonService::getAllBelongsToTopics($topics);
        }

        return $lessons;
    }

    public function getAllInPublic(){

        return LessonService::getAllInPublic();
    }
}
