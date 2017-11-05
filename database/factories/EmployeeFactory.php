<?php

use Faker\Generator as Faker;

$factory->define(Nero\Evale\Models\Employee::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'cpf' => rand(10000000000, 99999999999),
        'registration_number' => rand(10000000, 99999999),
        'consumption_limit' => $faker->randomFloat(2, 0, 100000),
        'password' => $password ?: $password = bcrypt($faker->password(6, 8)),
        'company_id' => $faker->randomNumber(2),
    ];
});
