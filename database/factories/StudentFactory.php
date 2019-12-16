<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Student::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'surname' => $faker->surname,
        'department' => $faker->department,
    ];
});