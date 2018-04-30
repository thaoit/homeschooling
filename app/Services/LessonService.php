<?php

namespace App\Services;

use Config;
use App\Models\Lesson;

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
}
