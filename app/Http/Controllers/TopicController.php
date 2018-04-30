<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Services\TopicService;
use App\Services\LessonTopicService;

use Illuminate\Http\Request;

class TopicController extends Controller
{
    //

    public function search(Request $request){

        $name = $request->get('name');
        return Topic::where('name', 'like', "$name%")
              ->orderBy('name', 'desc')
              ->get();
    }

    public function doStoreUpdateDelete(Request $request){

        $input = $request->all();

        // variables for returning
        $success = true;
        $new_topics_id = array();

        // check new topics
        if(isset( $input['new'] )){

            // create new topics
            $result = TopicService::storeArr($input['new']);
            $new_topics_id = $result['id'];

            // create link between lesson and topics
            $lesson_topic = TopicService::getArrayOfLessonTopicFromTopicId( $new_topics_id, $input['lesson_id'] );
            LessonTopicService::storeArr( $lesson_topic );
        }

        // check updated topics
        if(isset( $input['update'] )){

            // create link between lesson and topics
            $lesson_topic = TopicService::getArrayOfLessonTopicFromTopicObj( $input['update'], $input['lesson_id'] );
            LessonTopicService::storeArr( $lesson_topic );
        }

        // check deleted topics
        if(isset( $input['delete'] )){

            // create link between lesson and topics
            $lesson_topic = TopicService::getArrayOfLessonTopicFromTopicId( $input['delete'], $input['lesson_id'] );
            LessonTopicService::deleteArr( $lesson_topic );
        }

        return [
            'success' => $success,
            'new_topics_id'=> $new_topics_id
        ];
    }
}
