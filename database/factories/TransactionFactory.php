<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Transaction::class, function (Faker $faker) {
    $status = array('initiated', 'failed', 'completed');

    return [
        'qrcode_id' => function () {
            return App\Models\Qrcode::all()->random();
        },
        'qrcode_owner_id' => function () {
            return App\Models\Qrcode::all()->random();
        },
        'user_id' => function () {
            return App\Models\User::all()->random();
        },
        'payment_method' => 'Paystack/'.$faker->creditCardType,
        'amount' => $faker->numberBetween(200, 4000),
        'status' => $status[rand(0, 2)],
    ];
});
