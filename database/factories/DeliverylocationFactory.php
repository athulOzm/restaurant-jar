<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Branch;
use App\Deliverylocation;
use Faker\Generator as Faker;

$factory->define(Deliverylocation::class, function (Faker $faker) {
    return [
        'name'  =>  $faker->streetName,
        'branch_id'   =>  $faker->randomElement(Branch::all()->pluck('id')->toArray())
    ];
});
