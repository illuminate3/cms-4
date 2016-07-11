<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\Campaign::class, function(Faker\Generator $faker) {
    return [
        'script' => $faker->randomNumber,
        'name' => $faker->name
    ];
});

$factory->define(App\Models\Rebuttal::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'body' => $faker->text
    ];
});

$factory->define(App\Models\Promo::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'body' => $faker->text
    ];
});