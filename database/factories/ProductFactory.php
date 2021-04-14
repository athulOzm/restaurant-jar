<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\User;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->title(6),
        'user_id'   => User::first(),
        'price' =>  rand(6, 25),
        'body'  =>  $faker->text(10),
        'cover' =>  'test.jpg'
    ];
});
