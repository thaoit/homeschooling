<?php
namespace App\Services;

use App\Models\Reference;

class ReferenceService{

    public static function store($object){

        $find = Reference::where('lesson_id', $object['lesson_id'])
                          ->where('media_id', $object['media_id'])
                          ->count();

        if($find == 0){

            $reference = new Reference;
            $reference->lesson_id = $object['lesson_id'];
            $reference->media_id = $object['media_id'];
            $reference->save();

            return true;
        }

        return false;
    }

    public static function storeArr($array){

        $success = true;

        foreach ($array as $object) {

            if( !ReferenceService::store( $object ) ){
                $success = false;
            }
        }

        return $success;
    }

    public static function delete($object){

        $reference = Reference::where('lesson_id', $object['lesson_id'])
                              ->where('media_id', $object['media_id']);

        if($reference->count() == 0)
            return false;

        $reference->delete();

        return true;
    }

    public static function deleteArr($array){

        $success = true;

        foreach ($array as $object) {

            if( !ReferenceService::delete($object) ){
                $success = false;
            }
        }

        return $success;
    }

    public static function getArrayOfReferencesFromMediaObj($medias, $lesson_id){

        $array = array();

        foreach ($medias as $media) {

            $array[] = array(
                'lesson_id' => $lesson_id,
                'media_id' => $media['media_id']
            );
        }

        return $array;
    }

    public static function getArrayOfReferencesFromMediaId($media_ids, $lesson_id){

        $array = array();

        foreach ($media_ids as $media_id) {

            $array[] = array(
              'lesson_id' => $lesson_id,
              'media_id' => $media_id
            );
        }

        return $array;
    }
}
