<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        "first_name"=>$faker->name,
        "last_name"=>$faker->name,
        "email"=>$faker->unique()->safeEmail(),
        "password"=>'$2y$10$fYcXgOXDsVw5adIDy92kiuFUg/XJI/5AKBmU6lsp.zUuKKVMg0NSu',
    ];
});
