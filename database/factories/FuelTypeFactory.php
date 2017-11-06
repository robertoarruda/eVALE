<?php

use Faker\Generator as Faker;

$factory->define(Nero\Evale\Models\FuelType::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
    ];
});
