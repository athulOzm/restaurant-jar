<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Branch;
use App\Table;
use Faker\Generator as Faker;

$factory->define(Table::class, function (Faker $faker) {
    return [
        'name'  =>  $faker->randomLetter,
        'chair' =>  4,
        'branch_id'   =>  $faker->randomElement(Branch::all()->pluck('id')->toArray())
    ];
});
