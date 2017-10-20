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

$factory->define(Nero\ValeExpress\Models\FuelStation::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'cnpj' => rand(10000000000000, 99999999999999),
        'address' => $faker->address,
        'phone' => $faker->phoneNumberCleared,
    ];
});