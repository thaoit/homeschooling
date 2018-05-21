<?php

namespace App\Http\Controllers;

use App\Services\GeneralService;
use App\Services\LessonService;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function saveAllRelatingLesson(Request $request){

        $input = $request->all();

        // validate input
        $validator = LessonService::validate( $input['general'] );

        if( $validator->fails() ){

            return [
                'errors' => $validator->errors()->all()
            ];
        }

        // validate ok, variables for returning
        $success = true;
        $lesson_id;
        $new_outlines_id = array();
        $new_topics_id = array();

        // save general about lesson and get the id returned
        $lesson_id = GeneralService::saveGeneral($input['general']);

        if($lesson_id <= 0){
            $success = false;
        }
        else{

            // save outlines in lesson
            if( isset($input['outlines']) ){

                $result = GeneralService::saveOutlines(
                            $input['outlines'],
                            $lesson_id
                );
                $new_outlines_id = $result['new_outlines_id'];
            }

            // save topics which lesson belongs to
            if( isset($input['topics']) ){

                $result = GeneralService::saveTopics(
                            $input['topics'],
                            $lesson_id
                );
                $new_topics_id = $result['new_topics_id'];
            }

            // save link between lesson and medias
            if( isset($input['media_references']) ){

                $result = GeneralService::saveMediaReferences(
                            $input['media_references'],
                            $lesson_id
                );
            }
        }

        // return
        return [
          'success' => $success,
          'id' => $lesson_id,
          'new_outlines_id' => $new_outlines_id,
          'new_topics_id' => $new_topics_id
        ];
    }
}
