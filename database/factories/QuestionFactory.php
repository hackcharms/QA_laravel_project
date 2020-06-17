<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {

        $best_answer_id=rand(0,1)?User::pluck('id')->random():null;

    return [
        'title'=>rtrim($faker->sentence(rand(5,10)),'.'),
        'body'=>$faker->paragraph(rand(2,7)),
        'views'=>rand(0,20),
        // 'votes_count'=>rand(-3,20),
        // 'answers_count'=>rand(0,20),
        'best_answer_id'=>$best_answer_id
    ];
});
