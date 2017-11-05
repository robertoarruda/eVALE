<?php

use Faker\Generator as Faker;

$factory->define(Nero\Evale\Models\FillUp::class, function (Faker $faker) {
    return [
        'company_id' => $faker->randomNumber(2),
        'employee_id' => $faker->randomNumber(2),
        'fuel_type_id' => $faker->randomNumber(2),
        'value' => $faker->randomFloat(2, 0, 100000),
    ];
});