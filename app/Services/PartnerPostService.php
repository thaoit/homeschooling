<?php
namespace App\Services;

use Config;
use App\Models\PartnerPost;
use Illuminate\Support\Facades\DB;

class PartnerPostService{

    public static function store($object){

        $post = new PartnerPost;

        $post->age_from = $object['age_from'];
        $post->age_to = $object['age_to'];
        $post->gender = $object['gender'];
        $post->favorite_topics = $object['favorite_topics'];
        $post->country = $object['countries'];
        $post->province = $object['provinces'];
        $post->other_info = $object['other_info'];
        $post->user_id = $object['user_id'];

        $post->save();

        return $post->id;
    }

    public static function delete($id){

        $post = PartnerPost::find($id);

        if($post == null){
            return false;
        }

        return $post->delete();
    }

    public static function getAuthorId($post_id){

        $post = PartnerPost::find($post_id);

        if($post == null){
            return null;
        }

        return $post->user_id;
    }

    public static function getAllNotByUser($user_id){

        return DB::table('partner_posts')
                  ->join('users', 'partner_posts.user_id', '=', 'users.id')
                  ->where('users.id', '<>', $user_id)
                  ->select('partner_posts.*', 'users.id as user_id', 'users.username as user_name')
                  ->latest()
                  ->get();
    }

    public static function getAllByUser($user_id){

        return DB::table('partner_posts')
                  ->join('users', 'partner_posts.user_id', '=', 'users.id')
                  ->where('users.id', '=', $user_id)
                  ->select('partner_posts.*', 'users.id as user_id', 'users.username as user_name')
                  ->latest()
                  ->get();
    }

    public static function searchPostNotByUser($user_id, $object){

        $query = DB::table('partner_posts')
                    ->join('users', 'partner_posts.user_id', '=', 'users.id')
                    ->where('users.id', '<>', $user_id)
                    ->select('partner_posts.*', 'users.id as user_id', 'users.name as user_name')
                    ->latest();

        PartnerPostService::queryAge($query, $object['age_from'], $object['age_to']);
        PartnerPostService::queryGender($query, $object['gender']);
        PartnerPostService::queryFavoriteTopic($query, $object['favorite_topics']);
        PartnerPostService::queryAddress($query, $object['countries'], $object['provinces']);

        return $query->get();
    }

    public static function searchPostByUser($user_id, $object){

        $query = DB::table('partner_posts')
                    ->join('users', 'partner_posts.user_id', '=', 'users.id')
                    ->where('users.id', '=', $user_id)
                    ->select('partner_posts.*', 'users.id as user_id', 'users.name as user_name')
                    ->latest();

        PartnerPostService::queryAge($query, $object['age_from'], $object['age_to']);
        PartnerPostService::queryGender($query, $object['gender']);
        PartnerPostService::queryFavoriteTopic($query, $object['favorite_topics']);
        PartnerPostService::queryAddress($query, $object['countries'], $object['provinces']);

        return $query->get();
    }

    public static function queryAge($query, $age_from, $age_to){

        if( $age_from == null && $age_to == null ){
            return;
        }
        else if( $age_from == null &&  $age_to != null){
            $age_from = $age_to;
        }
        else if( $age_from != null && $age_to == null ){
            $age_to = $age_from;
        }

        $query->where(function($q) use ($age_from, $age_to){

            return $q->where([
                                    ['age_from', '<>', NULL],
                                    ['age_to', '=', NULL],
                                    ['age_from', '<=', $age_from]
                          ])
                          ->orWhere([
                                    ['age_from', '=', NULL],
                                    ['age_to', '<>', NULL],
                                    ['age_to', '>=', $age_to]
                          ])
                          ->orWhere([
                                    ['age_from', '<>', NULL],
                                    ['age_to', '<>', NULL],
                                    ['age_from', '<=', $age_from],
                                    ['age_to', '>=', $age_to]
                          ])
                          ->orWhere([
                                    ['age_from', '=', NULL],
                                    ['age_to', '=', NULL]
                          ]);
        });
    }

    public static function queryGender($query, $gender){

        if( $gender != null && $gender != Config::get('constants.gender.all') ){

            $query->where(function($q) use ($gender){

                return $q->where('partner_posts.gender', '=', $gender)
                         ->orWhere('partner_posts.gender', '=', Config::get('constants.gender.all'));
            });
        }
    }

    // $topics_string has the format: 'A, B, C'
    // note: A and B and C are topic names
    public static function queryFavoriteTopic($query, $topics_string){

        if( $topics_string != null ){

            $topics = explode(', ', $topics_string);

            $query->where(function($q) use ($topics){

                $q->where('favorite_topics', '=', NULL);

                for($i = 0; $i < count($topics); $i++){

                    $q->orWhere('favorite_topics', 'like', "%$topics[$i]%");
                }
            });
      }
    }

    public static function queryAddress($query, $country, $province){

        if( $country == null || $country == 'All' ){
            return;
        }
        else if( $province == null || $province == 'All' ){

            $query->where(function($q) use ($country){

                return $q->where('country', '=', $country)
                        ->orWhere('country', '=', 'All');
            });
        }
        else{

            $query->where(function($q) use ($country, $province){

                return $q->where([ ['country', '=', $country], ['province', '=', $province] ])
                        ->orWhere([ ['country', '=', $country], ['province', '=', 'All'] ])
                        ->orWhere('country', '=', 'All');
            });
        }
    }
}
