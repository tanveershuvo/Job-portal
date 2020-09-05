<?php

use Carbon\Carbon;
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
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'admin@demo.com',
            'password' => bcrypt('123456'),
            'gender' => 'male',
            'phone' => '+8801683182337',
            'user_type' => 'admin',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'Tanveer Employer',
            'email' => 'tanveershuvos@gmail.com',
            'password' => bcrypt('123456'),
            'phone' => '+8801683182339',
            'user_type' => 'employer',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'Rahman Job Seeker',
            'email' => 'tanveershuvo12@gmail.com',
            'password' => bcrypt('123456'),
            'gender' => 'male',
            'phone' => '+8801683182338',
            'user_type' => 'jobseeker',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
