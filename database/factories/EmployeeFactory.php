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

$factory->define(Nero\Evale\Models\Employee::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'cpf' => rand(10000000000, 99999999999),
        'registration_number' => rand(10000000, 99999999),
        'consumption_limit' => $faker->randomFloat(2, 0, 100000),
        'password' => $password ?: $password = bcrypt($faker->password(6, 8)),
    ];
});

$factory->defineAs(Nero\Evale\Models\Employee::class, 'create', function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'cpf' => rand(10000000000, 99999999999),
        'registration_number' => rand(10000000, 99999999),
        'consumption_limit' => $faker->randomFloat(2, 0, 100000),
        'password' => $password ?: $password = bcrypt($faker->password(6, 8)),
        'company_id' => factory(Nero\Evale\Models\Company::class)->create()->id,
    ];
});
