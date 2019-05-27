<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Log::class, function (Faker $faker) {
    return [
        'data_hora' => $faker->data_hora,
        'tipo' => $faker->text,
        'mensagem' => $faker->text,
        'usuario' => $faker->name,
        'aplicacao' => $faker->text
    ];
});
