<?php

namespace App\Http\Controllers;

use Config;
use App\Models\Lesson;
use App\Services\LessonService;
use App\Services\TopicService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    //

    public function index(){

        $lessons = LessonService::getAllByUserRequest(Auth::user()->id);
        $topics = TopicService::getAllInOrder('asc');

        return view('lesson/index', compact('lessons', 'topics'));
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

    public function resources(Request $request){

        $lessons = LessonService::getAllInPublic();
        $topics = TopicService::getAllInOrder('asc');

        return view('community/resource', compact('lessons', 'topics'));
    }

    public function filterLessonsByTopics(Request $request){

        $input = $request->all();
        $lessons = array();

        // check whether passing parameter exists
        /*if( isset( $input['topics'] ) && isset( $input['lesson_ids']  ){

            $lessons = LessonService::getAllBelongsToTopics($input['topics'], $input['lesson_ids']);
        }*/

        if( isset( $input['topics'] ) ){

            $search_text = isset( $input['search_text'] ) ? $input['search_text'] : '';
            $user_id = Auth::user()->id;
            $lessons = LessonService::getAllBelongsToTopicsAndNameHintsByUserRequest(
                                        $input['topics'],
                                        $search_text,
                                        $user_id
                                      );
        }

        return $lessons;
    }

    public function filterLessonsByName(Request $request){

        $input = $request->all();
        $lessons = array();

        // check whether passing parameter exists
        /*if( isset( $input['is_all'] ) ){

            if($input['is_all'] === "true"){
                $lessons = LessonService::getAllInPublic();
            }
            else{
                $lessons = LessonService::searchName($input['name']);
            }
        }*/

        $user_id = Auth::user()->id;

        if( isset( $input['search_text'] ) ){

            $lessons = LessonService::searchLessonNameByUserRequest($input['search_text'], $user_id);
        }
        else{

            $lessons = LessonService::getAllByUserRequest($user_id);
        }

        return $lessons;
    }

    public function searchNameInResource(Request $request){

        $input = $request->input();
        $lessons = array();
        $search = '';

        $topics = TopicService::getAllInOrder('asc');

        if( isset( $input['q'] ) ){

            $search = $input['q'];
            $lessons = LessonService::searchName($search);
        }

        return view('community/resource', compact('lessons', 'topics', 'search'));
    }

    public function searchNameInLesson(Request $request){

        $input = $request->input();
        $lessons = array();
        $search = '';

        $topics = TopicService::getAllInOrder('asc');

        if( isset( $input['q'] ) ){

            $search = $input['q'];
            $user_id = Auth::user()->id;
            $lessons = LessonService::searchLessonNameByUserRequest($search, $user_id);
        }

        return view('lesson/index', compact('lessons', 'topics', 'search'));
    }

    public function loveLesson(Request $request){

        $input = $request->all();
        $result = false;

        if( isset($input['lesson_id']) && isset($input['user_id']) ){

            $result = LessonService::loveLesson( $input['lesson_id'], $input['user_id'] );
        }

        return [
            'result' => $result
        ];
    }

    public function unloveLesson(Request $request){

        $input = $request->all();
        $result = false;

        if( isset($input['lesson_id']) && isset($input['user_id']) ){

            $result = LessonService::unloveLesson( $input['lesson_id'], $input['user_id'] );
        }

        return [
            'result' => $result
        ];
    }
}
