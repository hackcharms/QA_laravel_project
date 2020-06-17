<?php

use App\Answer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            favoriteQuestionsSeeder::class,
            UsersQuestionsAnswersTableSeeder::class,
            VotableTableSeeder::class,

        ]);

    }
}
