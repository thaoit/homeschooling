<?php
namespace App\Services;

use App\Models\Outline;

class OutlineService{

    public static function store($object){

        $outline = new Outline;

        $outline->name = $object['name'];
        $outline->content = $object['content'];
        $outline->lesson_id = $object['lesson_id'];

        $outline->save();

        return $outline->id;
    }

    public static function storeArr($array){

        $success = true;
        $new_outlines_id = array();

        foreach ($array as $object) {

            $id = OutlineService::store($object);

            if($id > 0){
                $new_outlines_id[] = $id;
            }
            else{
                $success = false;
                break;
            }
        }

        return [
           'success' => $success,
           'id' => $new_outlines_id
        ];
    }

    public static function update($object){

        $outline = Outline::find($object['id']);

        if($outline == null)
            return false;

        $outline->name = $object['name'];
        $outline->content = $object['content'];
        $outline->lesson_id = $object['lesson_id'];

        $outline->save();

        return true;
    }

    public static function updateArr($array){

        $success = true;

        foreach ($array as $object) {
            if(!OutlineService::update( $object )){
                $success = false;
            }
        }

        return $success;
    }

    public static function delete($id){

        $outline = Outline::find($id);

        if($outline == null)
            return false;

        $outline->delete();
        return true;
    }

    public static function deleteArr($array){

        $success = true;

        foreach ($array as $id) {
            if(!OutlineService::delete($id)){
                $success = false;
            }
        }

        return $success;
    }

    // objects are new, not contains id or lesson id
    public static function getArrayOfOutlineFromObj($objects, $lesson_id){

        $array = array();

        foreach ($objects as $object) {

            $array[] = array(
              'id' => isset($object['id']) ? $object['id'] : null,
              'name' => $object['name'],
              'content' => $object['content'],
              'lesson_id' => $lesson_id
            );
        }

        return $array;
    }
}
