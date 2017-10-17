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
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Nero\ValeExpress\Models\FuelStation::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'cnjp' => rand(11111111111111, 99999999999999),
        'address' => $faker->address,
        'phone' => $faker->phoneNumberCleared,
    ];
});

$factory->define(Nero\ValeExpress\Models\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'cnjp' => rand(11111111111111, 99999999999999),
        'address' => $faker->address,
        'phone' => $faker->phoneNumberCleared,
    ];
});

$factory->define(Nero\ValeExpress\Models\Employee::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'registration_number' => rand(11111111111111, 99999999999999),
        'balance' => rand(10, 99),
    ];
});
