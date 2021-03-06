<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Branch;
use Faker\Generator as Faker;

$factory->define(Branch::class, function (Faker $faker) {
    return [
        'name'  =>  'Branch 1',
        'code'  =>  'BR'.$faker->stateAbbr()
    ];
});
