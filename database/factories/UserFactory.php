<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
 */

$factory->define(App\User::class, function (Faker $faker) {
    $input = array("user", "employer");

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'country_id' => App\Country::pluck('id')->random(),
        'country_name' => App\Country::pluck('country_name')->random(),
        // 'state_id' => rand(10, 100),
        // $table->string('state_name')->nullable();
        // $table->string('city')->nullable();
        // $table->enum('gender', ['male', 'female'])->nullable();
        // $table->string('address')->nullable();
        // $table->string('address_2')->nullable();
        // $table->string('website')->nullable();
        // $table->string('phone')->nullable();
        // $table->string('photo')->nullable();
        'user_type' => $input[array_rand($input)],

// $table->string('company')->nullable();
        // $table->string('company_slug')->nullable();
        // $table->string('company_size', 5)->nullable();
        // $table->text('about_company')->nullable();
        // $table->string('logo')->nullable();

// $table->integer('premium_jobs_balance')->default(0)->nullable();
        // //active_status 0:pending, 1:active, 2:block;
        // $table->tinyInteger('active_status')->default(0);

    ];
});
