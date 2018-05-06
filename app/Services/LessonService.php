<?php

namespace App\Services;

use Config;
use App\Models\Lesson;
use App\Models\User;
use App\Models\LessonTopic;
use App\Models\Reference;
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

        $lesson->outlines()->delete();
        LessonTopic::where('lesson_id', $id)->delete();
        Reference::where('lesson_id', $id)->delete();

        $lesson->delete();
    }

    public static function getAllByUser($user_id){

        $role = UserService::getRole($user_id);

        switch ($role) {
          case Config::get('constants.role.admin'):
              $lessons = Lesson::orderBy('created_at', 'desc')->get();
              break;

          case Config::get('constants.role.parent'):
              $lessons = Lesson::where('author_id', $user_id)->latest()->get();
              break;

          case Config::get('constants.role.child'):
              $parent_id = UserService::getParentId($user_id);
              if($parent_id != null){
                  $lessons = Lesson::where('author_id', $parent_id)->latest()->get();
              }

          default:
              $lessons = array();
            break;
        }

        return $lessons;
    }

    public static function getAllInPublic(){

        // get all lesson ids having public status and,
        // ordered by the number of love and latest created time
        $lesson_id_array =  Lesson::where('status', Config::get('constants.lesson_status.publish'))
                                   ->orderBy('no_of_love', 'desc')
                                   ->latest()
                                   ->pluck('id');

        $lesson = array();

        foreach($lesson_id_array as $id){
            $lesson[] = LessonService::getAllRelatingLesson($id);
        }

        return $lesson;
    }

    public static function getAllBelongsToTopics($topics){

        // get lessons have topics in the input and,
        // order by the largest number of topics in the $topics input and,
        // order by the no of love
        // return array of lesson id
        $filter_lesson_ids = DB::table('lesson_topics')
                            ->join('lessons', 'lesson_topics.lesson_id', '=', 'lessons.id')
                            ->join('topics', 'lesson_topics.topic_id', '=', 'topics.id')
                            ->whereIn('topics.name', $topics)
                            ->where('lessons.status', Config::get('constants.lesson_status.publish'))
                            ->groupBy('lessons.id')
                            ->orderByRaw('count(*) desc')
                            ->orderBy('lessons.no_of_love', 'desc')
                            ->pluck('lessons.id');


        $filter_lessons = LessonService::getAllRelatingArrayOfLessons($filter_lesson_ids->toArray());

        return $filter_lessons;
    }

    public static function getById($lesson_id){

        return Lesson::find($lesson_id);
    }

    public static function getAllRelatingLesson($lesson_id){

        $lesson = Lesson::find($lesson_id);

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

        return [
          'general' => $lesson,
          'outlines' => $outlines,
          'media' => $media,
          'topics' => $topics,
          'split_outline_contents' => $split_outline_contents
        ];
    }

    public static function getAllRelatingArrayOfLessons($lesson_ids){

        $lessons = array();

        foreach($lesson_ids as $id){

            $lesson = LessonService::getAllRelatingLesson($id);

            // check if there is info about this lesson
            if( count($lesson) > 0){
                $lessons[] = $lesson;
            }
        }

        return $lessons;
    }
}
