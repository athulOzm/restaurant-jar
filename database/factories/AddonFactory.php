<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Addon;
use Faker\Generator as Faker;

$factory->define(Addon::class, function (Faker $faker) {
    return [
        'name' => 'water',
        'price' =>  '.400',
        'qty'   =>  10
    ];
});
