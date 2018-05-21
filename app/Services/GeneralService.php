<?php
namespace App\Services;

use App\Services\LessonService;
use App\Services\OutlineService;
use App\Services\TopicService;
use App\Services\LessonTopicService;
use App\Services\ReferenceService;
use Illuminate\Support\Facades\Auth;

class GeneralService{

    // return lesson id
    public static function saveGeneral($general){

        $general['author_id'] = Auth::user()->id;

        if( !isset( $general['id'] ) ){
            $lesson_id = LessonService::store( $general );
        }
        else{
            $lesson_id = $general['id'];
            LessonService::update( $general );
        }

        return $lesson_id;
    }

    // return status and array of new outlines id
    public static function saveOutlines($outlines, $lesson_id){

        // variables for returning
        $success = true;
        $new_outlines_id = array();

        // check new outlines
        if(isset( $outlines['new'] )){

            $array = OutlineService::getArrayOfOutlineFromObj( $outlines['new'], $lesson_id );
            $result = OutlineService::storeArr( $array );
            $new_outlines_id = $result['id'];
        }

        // check update outlines
        if(isset( $outlines['update'] )){

            $array = OutlineService::getArrayOfOutlineFromObj( $outlines['update'], $lesson_id);
            OutlineService::updateArr( $array );
        }

        // check delete outlines
        if(isset( $outlines['delete'] )){

            OutlineService::deleteArr( $outlines['delete'] );
        }

        return [
          'success' => $success,
          'new_outlines_id' => $new_outlines_id
        ];
    }

    // return status and array of new topics id
    public static function saveTopics($topics, $lesson_id){

        // variables for returning
        $success = true;
        $new_topics_id = array();

        // check new topics
        if(isset( $topics['new'] )){

            // create new topics
            $result = TopicService::storeArr( $topics['new'] );
            $new_topics_id = $result['id'];

            // create link between lesson and topics
            $lesson_topic = TopicService::getArrayOfLessonTopicFromTopicId( $new_topics_id, $lesson_id );
            LessonTopicService::storeArr( $lesson_topic );
        }

        // check updated topics
        if(isset( $topics['update'] )){

            // create link between lesson and topics
            $lesson_topic = TopicService::getArrayOfLessonTopicFromTopicObj( $topics['update'], $lesson_id );
            LessonTopicService::storeArr( $lesson_topic );
        }

        // check deleted topics
        if(isset( $topics['delete'] )){

            // create link between lesson and topics
            $lesson_topic = TopicService::getArrayOfLessonTopicFromTopicId( $topics['delete'], $lesson_id );
            LessonTopicService::deleteArr( $lesson_topic );
        }

        return [
            'success' => $success,
            'new_topics_id'=> $new_topics_id
        ];
    }

    public static function saveMediaReferences($media_refs, $lesson_id){

        // check new media references
        if(isset( $media_refs['new'] )){

            $reference = ReferenceService::getArrayOfReferencesFromMediaObj($media_refs['new'], $lesson_id);
            ReferenceService::storeArr( $reference );
        }

        // check delete media references
        if(isset( $media_refs['delete'] )){

            $reference = ReferenceService::getArrayOfReferencesFromMediaId($media_refs['delete'], $lesson_id);
            ReferenceService::deleteArr( $reference );
        }
    }

}
