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

        $user_id = ( Auth::check() ) ? Auth::user()->id : null;

        $lessons = LessonService::getAllByUserRequest($user_id, 0, Config::get('constants.max_loading_num'));
        $topics = TopicService::getAllInOrder('asc');

        return view('lesson/index', compact('lessons', 'topics'));
    }

    public function view($permalink){

        $id = LessonService::getLessonIDByPermalink($permalink);

        if( $id == null){

            return redirect()->action('HomeController@index');
        }
        else{

            $lesson = LessonService::getAllRelatingLesson($id);

            return view('lesson/view', compact('lesson'));
        }
    }

    public function create(){

        return view('lesson/create');
    }

    public function edit($permalink){

        $user_id = Auth::user()->id;
        $id = LessonService::getLessonIDByPermalink($permalink);

        if($id == null || $user_id != LessonService::getAuthorId($id)){

            return redirect()->action('HomeController@index');
        }
        else{

            $lesson = LessonService::getAllRelatingLesson($id);

            return view('lesson/edit', compact('lesson'));
        }
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

        $user_id = Auth::user()->id;
        $author_id = LessonService::getAuthorId($id);

        if( $user_id != $author_id ){

            return redirect()->action('HomeController@index');
        }
        else{

            LessonService::delete($id);
            return redirect()->action('LessonController@index');
        }
    }

    public function resources(Request $request){

        $user_id = ( Auth::check() ) ? Auth::user()->id : null;

        $lessons = LessonService::getAllInPublic($user_id, 0, Config::get('constants.max_loading_num'));
        $topics = TopicService::getAllInOrder('asc');

        return view('community/resource', compact('lessons', 'topics'));
    }

    public function filterLessonsByTopics(Request $request){

        $input = $request->all();
        $lessons = array();

        if( isset( $input['topics'] ) ){

            $search_text = isset( $input['search_text'] ) ? $input['search_text'] : '';
            $user_id = ( Auth::check() ) ? Auth::user()->id : null;

            // determine if request come from resource or not
            if( isset( $input['is_getting_only_publish'] ) && $input['is_getting_only_publish'] == "true" ){

                $lessons = LessonService::getAllBelongsToTopicsAndNameHintsInResource(
                                              $input['topics'],
                                              $search_text,
                                              $user_id,
                                              0,
                                              Config::get('constants.max_loading_num')
                                          );
            }
            else{

                $lessons = LessonService::getAllBelongsToTopicsAndNameHintsByUserRequest(
                                              $input['topics'],
                                              $search_text,
                                              $user_id,
                                              0,
                                              Config::get('constants.max_loading_num')
                                          );
            }
        }

        return $lessons;
    }

    public function filterLessonsByName(Request $request){

        $input = $request->all();
        $lessons = array();
        $user_id = ( Auth::check() ) ? Auth::user()->id : null;

        if( isset( $input['is_getting_only_publish'] ) ){

            $is_only_publish = $input['is_getting_only_publish'];

            if( $is_only_publish == "true" && isset( $input['search_text'] ) ){

                $lessons = LessonService::searchLessonNameInPublic(
                    $input['search_text'],
                    $user_id,
                    0,
                    Config::get('constants.max_loading_num')
                );
            }
            else if( $is_only_publish == "true" && !isset( $input['search_text'] ) ){

                $lessons = LessonService::getAllInPublic($user_id, 0, Config::get('constants.max_loading_num'));
            }
            else if( $is_only_publish == "false" && isset( $input['search_text'] ) ){

                $lessons = LessonService::searchLessonNameByUserRequest(
                    $input['search_text'],
                    $user_id,
                    0,
                    Config::get('constants.max_loading_num')
                  );
            }
            else{

                $lessons = LessonService::getAllByUserRequest($user_id, 0, Config::get('constants.max_loading_num'));
            }
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
            $user_id = ( Auth::check() ) ? Auth::user()->id : null;
            $lessons = LessonService::searchLessonNameInPublic($search, $user_id, 0, Config::get('constants.max_loading_num'));
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
            $user_id = ( Auth::check() ) ? Auth::user()->id : null;;
            $lessons = LessonService::searchLessonNameByUserRequest(
                          $search,
                          $user_id,
                          0,
                          Config::get('constants.max_loading_num')
                        );
        }

        return view('lesson/index', compact('lessons', 'topics', 'search'));
    }

    public function loveLesson(Request $request){

        $input = $request->all();
        $result = false;
        $message = array();

        // check whether user logined in
        if( Auth::check() ){

            $user_id = Auth::user()->id;
            if( isset($input['lesson_id']) ){

                $author_id = LessonService::getAuthorId( $input['lesson_id'] );

                if( $author_id != null && $user_id != $author_id ){
                    $result = LessonService::loveLesson( $input['lesson_id'], $user_id );
                }
                else{
                    $message[] = Config::get('constants.messages.unlike_ownself');
                }
            }
        }
        else{
            $message[] = Config::get('constants.messages.authentication');
        }

        return [
            'result' => $result,
            'errors' => $message
        ];
    }

    public function unloveLesson(Request $request){

        $input = $request->all();
        $result = false;
        $message = array();

        // check whether user logined in
        if( Auth::check() ){

            $user_id = Auth::user()->id;

            if( isset($input['lesson_id']) ){

                $author_id = LessonService::getAuthorId( $input['lesson_id'] );

                if( $author_id != null && $user_id != $author_id ){
                    $result = LessonService::unloveLesson( $input['lesson_id'], $user_id );
                }
                else{
                    $message[] = Config::get('constants.messages.unlike_ownself');
                }
            }
        }
        else{
            $message[] = Config::get('constants.messages.authentication');
        }

        return [
            'result' => $result,
            'errors' => $message
        ];
    }

    public function loadMoreLessons(Request $request){

        $input = $request->all();
        $lessons = array();

        if( isset( $input['offset'] ) ){

            $search_text = isset( $input['search_text'] ) ? $input['search_text'] : '';
            $user_id = ( Auth::check() ) ? Auth::user()->id : null;
            $offset = $input['offset'];
            $topics = isset( $input['topics'] ) ? $input['topics'] : null;

            // determine if request come from resource or not
            if( isset( $input['is_getting_only_publish'] ) && $input['is_getting_only_publish'] == "true"){

                $lessons = LessonService::getAllBelongsToTopicsAndNameHintsInResource(
                                              $topics,
                                              $search_text,
                                              $user_id,
                                              $offset,
                                              Config::get('constants.max_loading_num')
                                          );
            }
            else{

                $lessons = LessonService::getAllBelongsToTopicsAndNameHintsByUserRequest(
                                              $topics,
                                              $search_text,
                                              $user_id,
                                              $offset,
                                              Config::get('constants.max_loading_num')
                                          );
            }
        }

        return $lessons;
    }
}
