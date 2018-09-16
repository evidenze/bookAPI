<?php

use Illuminate\Support\Facades\Hash;

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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->userName,
        'email' => $faker->unique()->email,
        'password' => Hash::make('12345'),
    ];
});

$factory->define(App\Book::class, function (Faker\Generator $faker) {
    return [
        'book_title' => $faker->catchPhrase,
        'year_published' => $faker->year($max = 'now'),
        'isbn' => $faker->isbn13,
        'author_firstname' => $faker->firstName,
        'author_lastname' => $faker->LastName,
    ];
});

$factory->define(App\Rating::class, function (Faker\Generator $faker) {
    return [
        'value' => $faker->randomDigit,
        'book_id' => $faker->randomDigitNotNull,
    ];
});
