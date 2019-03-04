<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

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
    $passwordHash = Hash::make('password');
    $rememberToken = str_random(10);

    return [
        'name' => $faker->name,
        'role_id' => $faker->numberBetween(1, 4),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => $passwordHash, // secret
        'remember_token' => $rememberToken,
    ];
});
