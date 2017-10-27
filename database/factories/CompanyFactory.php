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

$factory->define(Nero\Evale\Models\Company::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->company,
        'cnpj' => rand(10000000000000, 99999999999999),
        'address' => $faker->address,
        'phone' => $faker->phoneNumberCleared,
        'subscription_limit' => $faker->randomFloat(2, 0, 100000),
        'remember_token' => str_random(10),
        'login' => strtolower($faker->firstName),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
