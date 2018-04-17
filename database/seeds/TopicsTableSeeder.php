<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('topics')->insert([

            'name' => 'Science',
            'num_of_lessons' => 2
        ]);

        DB::table('topics')->insert([

            'name' => 'Art'
        ]);
    }
}
