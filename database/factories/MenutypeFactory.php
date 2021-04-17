<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Menutype;
use Faker\Generator as Faker;

$factory->define(Menutype::class, function (Faker $faker) {
    return [
        'name'  =>  'Lunch',
        'from'  =>  '11:40',
        'to'    =>  '15:30'
    ];
});
