<?php
namespace App\Services;

use App\Models\LessonTopic;

class LessonTopicService{

    public static function store($object){

        // check if this object is existed or not
        $find = LessonTopic::where('lesson_id', $object['lesson_id'])
                            ->where('topic_id', $object['topic_id'])
                            ->count();

        // if not, add new
        if($find == 0){

            $lesson_topic = new LessonTopic;
            $lesson_topic->lesson_id = $object['lesson_id'];
            $lesson_topic->topic_id = $object['topic_id'];

            $lesson_topic->save();
            return true;
        }

        return false;
    }

    public static function storeArr($array){

        $success = true;

        foreach ($array as $object) {
            if(!LessonTopicService::store( $object )){
                $success = false;
            }
        }

        return $success;
    }

    public static function delete($object){

        $lesson_topic = LessonTopic::where('lesson_id', $object['lesson_id'])
                            ->where('topic_id', $object['topic_id']);

        if($lesson_topic->count() == 0)
            return false;

        $lesson_topic->delete();

        return true;
    }

    public static function deleteArr($array){

        $success = true;

        foreach ($array as $object) {
            if(!LessonTopicService::delete($object)){
                $success = false;
            }
        }

        return $success;
    }
}
