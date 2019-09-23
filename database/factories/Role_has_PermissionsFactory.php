<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Role_has_Permissions;
use Faker\Generator as Faker;

$factory->define(Role_has_Permissions::class, function (Faker $faker) {

    return [
        'role_id' => $faker->randomDigitNotNull
    ];
});
