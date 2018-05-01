<?php

namespace App\Services;

use Config;
use App\Models\Lesson;
use App\Models\User;
use App\Services\UserService;
use App\Services\MediaService;

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

    public static function getAllByUser($user_id){

        $role = UserService::getRole($user_id);

        switch ($role) {
          case Config::get('constants.role.admin'):
              $lessons = Lesson::orderBy('title', 'desc')->get();
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
      
        return [
          'general' => $lesson,
          'outlines' => $outlines,
          'media' => $media,
          'split_outline_contents' => $split_outline_contents
        ];
    }

}
