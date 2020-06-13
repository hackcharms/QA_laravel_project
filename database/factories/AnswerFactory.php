<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Answer;
use App\Question;
use App\User;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    return [
            'body'=>$faker->paragraph(rand(2,4),true),
            'user_id'=>User::pluck('id')->random()
    ];
});
