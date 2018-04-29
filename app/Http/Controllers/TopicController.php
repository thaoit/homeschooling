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

        $success = true;
        $new_topics_id = array();

        if(isset( $input['new'] )){

            $result = TopicService::storeArr($input['new']);
            $new_topics_id = $result['id'];

            $lesson_topic = TopicService::getArrayOfLessonTopicFromTopicId( $new_topics_id, $input['lesson_id'] );
            LessonTopicService::storeArr( $lesson_topic );
        }

        if(isset( $input['update'] )){

            //TopicService::updateArr($input['update']);

            $lesson_topic = TopicService::getArrayOfLessonTopicFromTopicObj( $input['update'], $input['lesson_id'] );
            LessonTopicService::storeArr( $lesson_topic );
        }

        if(isset( $input['delete'] )){

            $lesson_topic = TopicService::getArrayOfLessonTopicFromTopicId( $input['delete'], $input['lesson_id'] );
            LessonTopicService::deleteArr( $lesson_topic );

            //TopicService::deleteArr($input['delete']);
        }

        return [
            'success' => $success,
            'new_topics_id'=> $new_topics_id
        ];
    }
}
