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
        'email' => $faker->email,
        'password' => bcrypt('123123'),
        'remember_token' => str_random(10),
        'verified' => 1,

    ];
});

$factory->define(App\Grader::class, function (Faker\Generator $faker) {
    return [
        'last_name' => $faker->lastname,
        'first_name' => $faker->firstname,
        'specialty_id' => $faker->numberBetween(1, 20),
        'district_id' => $faker->numberBetween(1, 14),
    ];
});

$factory->define(App\Suggestion::class, function (Faker\Generator $faker) {
    return [

    ];
});
