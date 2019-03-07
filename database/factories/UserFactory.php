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
$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'first_name' => $faker->firstname,
        'last_name' => $faker->lastname,
        'password' => $faker->password,
    ];
});
