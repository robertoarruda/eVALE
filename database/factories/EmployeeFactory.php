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

$factory->define(Nero\ValeExpress\Models\Employee::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'cpf' => $faker->randomNumber(11),
        'registration_number' => $faker->randomNumber(8),
        'password' => $faker->password(6, 8),
    ];
});

$factory->defineAs(Nero\ValeExpress\Models\Employee::class, 'create', function (Faker $faker) {
    return [
        'name' => $faker->name,
        'cpf' => $faker->randomNumber(11),
        'registration_number' => $faker->randomNumber(8),
        'password' => $faker->password(6, 8),
        'company_id' => factory(Nero\ValeExpress\Models\Company::class)->create()->id,
    ];
});
