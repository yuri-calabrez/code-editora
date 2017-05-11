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
$factory->define(\CodeEduUser\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\CodeEduBook\Models\Category::class, function (Faker\Generator $faker) {

    return [
        'name' => ucfirst($faker->unique()->word),
    ];
});

$factory->define(\CodeEduBook\Models\Book::class, function (Faker\Generator $faker) {

    $repository = app(\CodeEduUser\Repositories\UserRepository::class);
    $authorId = $repository->all()->random()->id;

    return [
        'title' => $faker->sentence(2),
        'author_id' => $authorId,
        'subtitle' => $faker->sentence(3),
        'price' => $faker->randomFloat(2, 10, 100)
    ];
});