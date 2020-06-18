<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersQuestionsAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('questions')->delete();
        DB::table('answers')->delete();
        factory(App\User::class,5)->create()->each(function($user){
            $user->questions()
            ->saveMany(
                factory(App\Question::class,rand(1,5))->make()
            )->each(function($ques){
                $ques->answers()->saveMany(
                factory(App\Answer::class,rand(2,5))->make()
                );
            });
        });
    }
}
