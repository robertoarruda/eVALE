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

$factory->define(Nero\Evale\Models\FillUp::class, 'create', function (Faker $faker) {
    return [
        'company_id' => factory(Nero\Evale\Models\Company::class)->create()->id,
        'employee_id' => factory(Nero\Evale\Models\Employee::class)->create()->id,
        'fuel_type_id' => factory(Nero\Evale\Models\FuelType::class)->create()->id,
        'value' => $faker->randomFloat(2, 0, 100000),
    ];
});
