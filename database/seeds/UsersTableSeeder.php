<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([

            'name' => 'admin',
            'email' => '12345@mailinator.com',
            'password' => bcrypt('12345'),
            'gender' => Config::get('constants.gender.male'),
            'birthday' => '2018-02-15',
            'address' => 'US',
            'role' => Config::get('constants.role.admin')
        ]);
    }
}
