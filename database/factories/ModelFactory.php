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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Blog\Post::class, function (Faker\Generator $faker) {
    return [
        'user_id'      => function () {
            return factory(\App\User::class)->create()->id;
        },
        'title'        => $faker->sentence,
        'description'  => $faker->paragraph,
        'body'         => $faker->paragraphs(3, true),
        'published'    => false,
        'published_on' => null
    ];
});

$factory->define(App\Assocciates\Partner::class, function (Faker\Generator $faker) {
    return [
        'name'      => $faker->company,
        'writeup'   => $faker->paragraphs(3, true),
        'published' => false,
    ];
});

$factory->define(App\Assocciates\Sponsor::class, function (Faker\Generator $faker) {
    return [
        'name'      => $faker->company,
        'writeup'   => $faker->paragraphs(3, true),
        'published' => false,
    ];
});

$factory->define(App\Assocciates\TeamMember::class, function (Faker\Generator $faker) {
    return [
        'name'      => $faker->company,
        'writeup'   => $faker->paragraphs(3, true),
        'published' => false,
    ];
});

$factory->define(App\Compliance\Document::class, function (Faker\Generator $faker) {
    return [
        'title'      => $faker->words(3, true),
        'path'   => null,
        'published' => false,
    ];
});

$factory->define(App\Gallery\Album::class, function (Faker\Generator $faker) {
    return [
        'title'      => $faker->words(3, true),
        'published' => false,
    ];
});

$factory->define(App\Expeditions\Expedition::class, function (Faker\Generator $faker) {
    return [
        'name'      => $faker->words(3, true),
        'description' => $faker->paragraph,
        'duration' => $faker->sentence,
        'writeup' => $faker->paragraphs(3, true),
        'capacity' => $faker->sentence,
        'location' => $faker->address,
        'start_date' => $faker->sentence,
        'difficulty' => $faker->words(4, true),
        'published' => false,
    ];
});

$factory->define(App\Social\SocialLink::class, function (Faker\Generator $faker) {
    return [
        'sociable_id'   => function () {
            return factory(\App\Assocciates\Partner::class)->create()->id;
        },
        'sociable_type' => function () {
            return App\Assocciates\Partner::class;
        },
        'platform'      => $faker->randomElement(['twitter', 'facebook', 'email', 'instagram']),
        'url'          => $faker->url
    ];
});
