<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'first_name'      => $faker->name,
        'last_name'       => $faker->name,
        'email'           => $faker->email,
        'role_id'         => 1,
        'password'        => bcrypt(str_random(10)),
        'remember_token'  => str_random(10),
        'avatar'          => $faker->url,
    ];
});

$factory->define(App\Report::class, function (Faker\Generator $faker) {
    return [
        'statement'   => $faker->name,
        'description' => $faker->name,
        'user_id'     => 1,
        'patient_id'  => 1,
    ];
});

$factory->define(App\Patient::class, function (Faker\Generator $faker) {
    return [
        'email'         => $faker->email,
        'phone_number'  => $faker->phoneNumber,
        'name'          => $faker->text,
        'user_id'       => 1,
        'date_of_birth' => 1,
        'patient_id'    => str_random(10),
        'case_number'   => str_random(10),
    ];
});

