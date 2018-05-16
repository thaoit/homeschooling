<?php

namespace App\Services;

use Config;
use App\Models\Lesson;
use App\Models\User;
use App\Models\LessonTopic;
use App\Models\Reference;
use App\Models\FavoriteLesson;
use App\Services\UserService;
use App\Services\MediaService;
use Illuminate\Support\Facades\DB;

class LessonService{

    public static function validate($input){


    }

    public static function store($object){

        $lesson = new Lesson;

        $lesson->title = $object['title'];
        $lesson->intro = $object['intro'];
        $lesson->author_id = $object['author_id'];
        $lesson->status = ($object['is_publish'] == 'true') ? Config::get('constants.lesson_status.publish'): Config::get('constants.lesson_status.draft');

        // save and return id
        $lesson->save();

        return $lesson->id;
    }

    public static function update($object){

        $lesson = Lesson::find($object['id']);
        $success = false;

        if($lesson != null){

            $lesson->title = $object['title'];
            $lesson->intro = $object['intro'];
            $lesson->author_id = $object['author_id'];
            $lesson->status = ($object['is_publish'] == 'true') ? Config::get('constants.lesson_status.publish'): Config::get('constants.lesson_status.draft');

            $lesson->save();
            $success = true;
        }

        return $success;
    }

    public static function delete($id){

        $lesson = Lesson::find($id);

        if($lesson == null){
            return;
        }

        // delete references with the lesson
        $lesson->outlines()->delete();
        LessonTopic::where('lesson_id', $id)->delete();
        Reference::where('lesson_id', $id)->delete();
        FavoriteLesson::where('lesson_id', $id)->delete();

        // delete lesson
        $lesson->delete();
    }

    public static function getLessonQueryByUserRequest($user_id){

        $role = UserService::getRole($user_id);
        $query;

        switch ($role) {
          case Config::get('constants.role.admin'):
              // admin can view all lessons in draft and publish status
              $query = Lesson::all();
              break;

          case Config::get('constants.role.parent'):
              // parent only view their own lessons, in draft and publish status
              $query = Lesson::where('author_id', $user_id);
              break;

          case Config::get('constants.role.child'):
              // children only view their parent's lesson, only in publish status
              $parent_id = UserService::getParentId($user_id);
              if($parent_id != null){
                  $query = Lesson::where('author_id', $parent_id)
                                  ->where('status', Config::get('constants.lesson_status.publish'));
              }
              break;

          default:
              $query = null;
              break;
        }

        return $query;
    }

    public static function getAllByUserRequest($user_id){

        $query = LessonService::getLessonQueryByUserRequest($user_id);

        if($query == null){
            $lesson_id_array = array();
        }
        else{
            $lesson_id_array = $query->orderBy('created_at', 'desc')
                                      ->pluck('id');
        }

        $lessons = LessonService::getAllRelatingArrayOfLessons($lesson_id_array, $user_id);

        return $lessons;
    }

    public static function getAllInPublic($request_user_id){

        // get all lesson ids having public status and,
        // ordered by the number of love and latest created time
        $lesson_id_array =  Lesson::where('status', Config::get('constants.lesson_status.publish'))
                                   ->orderBy('no_of_love', 'desc')
                                   ->latest()
                                   ->pluck('id');

        $lesson = LessonService::getAllRelatingArrayOfLessons($lesson_id_array, $request_user_id);

        return $lesson;
    }

    // get all lessons which request user can access
    // with role admin: access all,
    // role parent: access only his/her own lessons
    // children: access only his/her parent's lessons in publish status
    public static function getAllBelongsToTopicsAndNameHintsByUserRequest($topics, $name, $user_id){

        $role = UserService::getRole($user_id);
        $filter_lesson_ids = array();

        $query =  DB::table('lesson_topics')
                    ->join('lessons', 'lesson_topics.lesson_id', '=', 'lessons.id')
                    ->join('topics', 'lesson_topics.topic_id', '=', 'topics.id');

        switch ($role) {

          case Config::get('constants.role.parent'):
              // parent only view their own lessons, in draft and publish status
              $query->where('lessons.author_id', $user_id);
              break;

          case Config::get('constants.role.child'):
              // children only view their parent's lesson, only in publish status
              $parent_id = UserService::getParentId($user_id);
              if($parent_id != null){
                  $query->where('lessons.author_id', $parent_id)
                        ->where('lessons.status', Config::get('constants.lesson_status.publish'));
              }
              break;

          default:
              $query = null;
              break;
        }

        // get lessons have topics in the input and,
        // order by the largest number of topics in the $topics input and,
        // order by the no of love
        // return array of lesson id
        if($query != null){

          $filter_lesson_ids = $query->where('title', 'like', "%$name%")
                              ->whereIn('topics.name', $topics)
                              ->groupBy('lessons.id')
                              ->orderByRaw('count(*) desc')
                              ->orderBy('lessons.no_of_love', 'desc')
                              ->pluck('lessons.id');
        }

        $filter_lessons = LessonService::getAllRelatingArrayOfLessons($filter_lesson_ids->toArray(), $user_id);

        return $filter_lessons;
    }

    // get all publish lessons, and
    // not depending on user or user's role
    public static function getAllBelongsToTopicsAndNameHintsInResource($topics, $name, $request_user_id){

        $filter_lesson_ids = array();

        $query =  DB::table('lesson_topics')
                    ->join('lessons', 'lesson_topics.lesson_id', '=', 'lessons.id')
                    ->join('topics', 'lesson_topics.topic_id', '=', 'topics.id')
                    ->where('lessons.status', Config::get('constants.lesson_status.publish'));

        // get lessons have topics in the input and,
        // order by the largest number of topics in the $topics input and,
        // order by the no of love
        // return array of lesson id
        if($query != null){

          $filter_lesson_ids = $query->where('title', 'like', "%$name%")
                              ->whereIn('topics.name', $topics)
                              ->groupBy('lessons.id')
                              ->orderByRaw('count(*) desc')
                              ->orderBy('lessons.no_of_love', 'desc')
                              ->pluck('lessons.id');
        }

        $filter_lessons = LessonService::getAllRelatingArrayOfLessons($filter_lesson_ids->toArray(), $request_user_id);

        return $filter_lessons;
    }

    public static function getById($lesson_id){

        return Lesson::find($lesson_id);
    }

    public static function getAuthorId($lesson_id){

        $lesson = Lesson::find($lesson_id);

        if($lesson == null){
            return null;
        }

        return $lesson->author_id;
    }

    public static function getAllRelatingLesson($lesson_id, $request_user_id){

        $lesson = Lesson::find($lesson_id);

        // author
        $author = $lesson->user()->first();

        // check lesson existed or not
        if($lesson == null){
            return array();
        }

        // get outlines
        $outlines = $lesson->outlines()->get();

        // split outlines if existed hr tag
        $split_outline_contents = array();

        foreach ($outlines as $outline) {

            $content = $outline->content;
            $split_contents = explode('<hr>', $content);
            $split_outline_contents[] = $split_contents;
        }

        // get media
        $media = MediaService::getCategorizedMediaBy($lesson_id);

        // get topics
        $topics = $lesson->topics()->get();

        // get favorite lessons of current user
        $favorite = FavoriteLessonService::getArrayOfFavoriteLessonIDsByUser($request_user_id);

        // determine if request user can control the lesson
        $request_user_role = UserService::getRole($request_user_id);

        if($request_user_role == null || $request_user_role == Config::get('constants.role.child')){
            $is_enable_control = false;
        }
        else{
            $is_enable_control = true;
        }

        return [
          'general' => $lesson,
          'outlines' => $outlines,
          'media' => $media,
          'topics' => $topics,
          'split_outline_contents' => $split_outline_contents,
          'is_control' => $is_enable_control,
          'favorite_lesson_ids' => $favorite,
          'author' => $author
        ];
    }

    public static function getAllRelatingArrayOfLessons($lesson_ids, $request_user_id = null){

        $lessons = array();

        foreach($lesson_ids as $id){

            $lesson = LessonService::getAllRelatingLesson($id, $request_user_id);

            // check if there is info about this lesson
            if( count($lesson) > 0){
                $lessons[] = $lesson;
            }
        }

        return $lessons;
    }

    public static function searchLessonNameByUserRequest($name, $user_id){

        $query = LessonService::getLessonQueryByUserRequest($user_id);

        if($query == null){
            $lesson_id_array = array();
        }
        else{
            $lesson_id_array = $query->where('title', 'like', "%$name%")
                                      ->orderBy('created_at', 'desc')
                                      ->pluck('id');
        }


        $lessons = LessonService::getAllRelatingArrayOfLessons($lesson_id_array, $user_id);

        return $lessons;
    }

    public static function searchLessonNameInPublic($name, $request_user_id){

        // get all lesson ids having public status and,
        // ordered by the number of love and latest created time
        $lesson_id_array =  Lesson::where('status', Config::get('constants.lesson_status.publish'))
                                   ->where('title', 'like', "%$name%")
                                   ->orderBy('no_of_love', 'desc')
                                   ->latest()
                                   ->pluck('id');

        $lesson = LessonService::getAllRelatingArrayOfLessons($lesson_id_array, $request_user_id);

        return $lesson;
    }

    public static function loveLesson($lesson_id, $user_id){

        $object = [
            'lesson_id' => $lesson_id,
            'user_id' => $user_id
        ];

        // add to favorite lessons and, return result
        return FavoriteLessonService::store($object);
    }

    public static function unloveLesson($lesson_id, $user_id){

        // delete favorite and, return result
        return FavoriteLessonService::delete($lesson_id, $user_id);
    }
}
