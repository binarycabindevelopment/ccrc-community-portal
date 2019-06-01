<?php

use App\ContactSubmission;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(ContactSubmission::class, function (Faker $faker) {
    return [
        'uuid' => $faker->uuid,
        'community_id' => null,
        'community_uuid' => null,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'message' => $faker->sentence,
        'subscribe' => $faker->boolean,
        'recipients' => null,
    ];
});
