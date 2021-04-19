<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Menutype;
use Faker\Generator as Faker;

$factory->define(Menutype::class, function (Faker $faker) {
    return [
        'name'  =>  'Breakfast',
        'from'  =>  '5:00',
        'to'    =>  '11:00'
    ];
});
