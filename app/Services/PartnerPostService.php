<?php
namespace App\Services;

use App\Models\PartnerPost;
use Illuminate\Support\Facades\DB;

class PartnerPostService{

    public static function store($object){

        $post = new PartnerPost;

        $post->age_from = $object['min_age'];
        $post->age_to = $object['max_age'];
        $post->gender = $object['gender'];
        $post->max_no_of_partners = $object['max_no_of_partners'];
        $post->favorite_topics = $object['favorite_topics'];
        $post->other_info = $object['other_info'];
        $post->user_id = $object['user_id'];
        $post->address = $object['countries'];
        if($object['provinces'] != "All"){
            $post->address = $object['provinces'].", $post->address";
        }

        $post->save();

        return $post->id;
    }

    public static function getAll(){

        return DB::table('partner_posts')
                  ->join('users', 'partner_posts.user_id', '=', 'users.id')
                  ->select('partner_posts.*', 'users.id as user_id', 'users.name as user_name')
                  ->latest()
                  ->get();
    }

    public static function search($object){

        return DB::table('partner_posts')
                  ->join('users', 'partner_posts.user_id', '=', 'users.id')
                  ->select('partner_posts.*', 'users.id as user_id', 'users.name as user_name')
                  ->where('max_no_of_partners', '<=', $object['max_no_of_partners'])
                  ->latest()
                  ->get();
    }
}
