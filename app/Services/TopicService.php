<?php
namespace App\Services;

use App\Models\Topic;
use App\Models\LessonTopic;
use App\Services\LessonTopicService;

class TopicService{

    public static function store($object){

        $topic = new Topic;
        $topic->name = $object['name'];
        $topic->save();

        return $topic->id;
    }

    public static function storeArr($array){

        $success = true;
        $new_topics_id = array();

        foreach ($array as $object) {

            $id = TopicService::store($object);

            if($id > 0){
                $new_topics_id[] = $id;
            }
            else{
                $success = false;
                break;
            }
        }

        return [
          'success' => $success,
          'id' => $new_topics_id
        ];
    }

    /*public static function update($object){

        $topic = Topic::find($object['id']);
        if($topic == null)
          return false;

        $topic->name = $object['name'];
        $topic->save();

        return true;
    }

    public static function updateArr($array){

        $success = true;

        foreach ($array as $object) {

            if(!TopicService::update($object)){
                $success = false;
            }
        }

        return $success;
    }

    public static function delete($id){

        $topic = Topic::find($object['id']);
        if($topic == null)
          return false;

        $topic->delete();

        return true;
    }

    public static function deleteArr($array){

        $success = true;

        foreach ($array as $object) {

            if(!TopicService::delete($object)){
                $success = false;
            }
        }

        return $success;
    }*/

    public static function getArrayOfLessonTopicFromTopicObj($objects, $lesson_id){

        $array = array();

        foreach ($objects as $object) {

            $array[] = array(
               'lesson_id' => $lesson_id,
               'topic_id' => $object['id']
            );
        }

        return $array;
    }

    public static function getArrayOfLessonTopicFromTopicId($ids, $lesson_id){

        $array = array();

        foreach ($ids as $id) {

            $array[] = array(
              'lesson_id' => $lesson_id,
              'topic_id' => $id
            );
        }

        return $array;
    }
}
