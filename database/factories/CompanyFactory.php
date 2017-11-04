<?php

use Faker\Generator as Faker;

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
        'password' => $password ?: $password = bcrypt($faker->password(6, 8)),
        'remember_token' => str_random(10),
    ];
});
