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

    public static function update($object){

        $outline = Outline::find($object['id']);

        if($outline == null)
            return false;

        $outline->name = $object['name'];
        $outline->content = $object['content'];
        $outline->lesson_id = $object['lesson_id'];

        return true;
    }

    public static function delete($id){

        $outline = Outline::find($id);

        if($outline == null)
            return false;

        $outline->delete();
        return true;
    }
}
