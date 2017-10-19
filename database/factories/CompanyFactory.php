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

$factory->define(Nero\ValeExpress\Models\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'cnpj' => $faker->randomNumber(8),
        'address' => $faker->address,
        'phone' => $faker->phoneNumberCleared,
        'subscription_limit' => $faker->randomFloat(2, 0, 100000),
    ];
});
