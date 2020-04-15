<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\House;
use Faker\Generator as Faker;

$factory->define(House::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => rand(11111, 99999),
        'bedrooms' => rand(1, 10),
        'bathrooms' => rand(1, 10),
        'storeys' => rand(1, 10),
        'garages' => rand(1, 10),
    ];
});
