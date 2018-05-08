<?php
namespace App\Services;

use App\Models\Lesson;
use App\Models\User;
use App\Models\FavoriteLesson;

class FavoriteLessonService{

    public static function store($object){

        $lesson = Lesson::find( $object['lesson_id'] );
        $user = User::find( $object['user_id'] );

        if($lesson == null || $user == null){
            return false;
        }

        // add to favorite
        $favorite = new FavoriteLesson;
        $favorite->lesson_id = $object['lesson_id'];
        $favorite->user_id = $object['user_id'];
        $b = $favorite->save();

        // inscrease no of love on lesson
        $lesson->no_of_love++;
        $lesson->save();

        return true;
    }

    public static function delete($lesson_id, $user_id){

        $favorite = FavoriteLesson::where([
                                            ['lesson_id', '=', $lesson_id],
                                            ['user_id', '=', $user_id]
                                          ]);

        if(count($favorite->get()) == 0){
            return false;
        }

        // remove from favorite
        $favorite->delete();

        // decrease no of love on lesson
        $lesson = Lesson::find($lesson_id);
        $lesson->no_of_love--;
        $lesson->save();

        return true;
    }

    public static function getArrayOfFavoriteLessonIDsByUser($user_id){

        $array = array();
        $user = User::find($user_id);

        // check if user exists
        if($user == null){
            return $array;
        }

        // get favorite lesson ids
        $lessons = $user->favorLessons()->get();
        foreach($lessons as $lesson){
            $array[] = $lesson->id;
        }

        return $array;
    }
}
