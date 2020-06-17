<?php

use App\Question;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class favoriteQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('favorite_questions')->delete();
        $users=User::pluck('id')->all();
        $numberOfUsers=count($users);
        foreach ( Question::all() as $question) {
                for($i=0;$i<(rand(1,$numberOfUsers));$i++)
                {
                    $user=$users[$i];
                    $question->favorites()->attach($user);
                }
        }
    }
}
