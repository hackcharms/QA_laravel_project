<?php

use App\Question;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VotableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('votables')->delete();
        $users=User::all();
        $numberOfUsers=$users->count();
        $votes=[-1,1];
        foreach(Question::all() as $question)
        {
            for($i=0;$i<rand(1,$numberOfUsers);$i++)
            {
                $users[$i]->voteQuestion($question,$votes[rand(0,1)]);
            }
            // for($i=0;$i<rand(1,$numberOfUsers);$i++)
            // {
            //     $users[$i]->voteAnswer($question,$votes[rand(0,1)]);
            // }

        }
    }
}
