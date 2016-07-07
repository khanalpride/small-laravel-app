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
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt('secret'),
        'remember_token' => str_random(10),
        'amount' => 10000,
        'level' => 'user'
    ];
});

$factory->define(App\Transaction::class, function (Faker\Generator $faker) {
    return [
        'user_id' => rand(1, 5),
        'amount' => rand(10, 500),
        'approved' => false
    ];
});
