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
            'user_type' => 'admin',
            'active_status' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
