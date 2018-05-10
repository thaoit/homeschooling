<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('partner_posts')->insert([

            'age_from' => 5,
            'age_to' => 12,
            'gender' => Config::get('constants.gender.all'),
            'favorite_topics' => 'Music, Art',
            'country' => 'Japan',
            'province' => 'All',
            'user_id' => 2
        ]);

        DB::table('partner_posts')->insert([

            'age_to' => 12,
            'gender' => Config::get('constants.gender.all'),
            'favorite_topics' => 'Science',
            'country' => 'Vietnam',
            'province' => 'Ha noi',
            'user_id' => 2
        ]);

        DB::table('partner_posts')->insert([

            'age_from' => 9,
            'gender' => Config::get('constants.gender.female'),
            'country' => 'All',
            'province' => 'All',
            'user_id' => 2
        ]);

        DB::table('partner_posts')->insert([

            'gender' => Config::get('constants.gender.others'),
            'favorite_topics' => 'Art, Song',
            'country' => 'Us',
            'province' => 'All',
            'other_info' => 'Joyful and positive',
            'user_id' => 2
        ]);
    }
}
