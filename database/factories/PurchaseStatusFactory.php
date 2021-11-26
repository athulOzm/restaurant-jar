<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PurchaseStatus;
use Faker\Generator as Faker;

$factory->define(PurchaseStatus::class, function (Faker $faker) {
    return [
        'name' => 'Received'
    ];
});
