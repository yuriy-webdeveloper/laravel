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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Flyer::class, function (Faker\Generator $faker) use ($factory) {
    return [
        'user_id'     => $factory->create(App\User::class)->id,
        'street'      => $faker->streetAddress,
        'city'        => $faker->city,
        'zip'         => $faker->postcode,
        'state'       => $faker->city,
        'country'     => $faker->country,
        'price'       => $faker->numberBetween(10000, 500000),
        'description' => $faker->paragraphs(3, true)
    ];
});

