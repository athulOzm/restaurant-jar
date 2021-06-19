<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Branch;
use App\Category;
use App\Product;
use App\User;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->text(6),
        'user_id'   => User::first(),
        'price' =>  rand(6, 25),
        'body'  =>  $faker->text(10),
        'category_id'   =>  $faker->randomElement(Category::where('parant_id', null)->pluck('id')->toArray()),
       // 'branch_id'   =>  $faker->randomElement(Branch::all()->pluck('id')->toArray())
    ];
});
