<?php

namespace Database\Seeders;

use App\Models\Achieve;
use App\Models\Answer;
use App\Models\Badge;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\posts;
use App\Models\comments;
use App\Models\Question;
use App\Models\Tag;
use App\Models\TagQuestion;
use App\Models\Vote;
use App\Models\VoteAnswer;
use App\Models\VoteQuestion;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    
    public function run()
    {
        
            User::factory(10)->create();
            Question::factory(10)->create();
            Answer::factory(10)->create();
            Comment::factory(10)->create();
            Tag::factory(10)->create();
            TagQuestion::factory(10)->create();   
            // Vote::factory(10)->create();
            // Badge::factory(10)->create();
            // Achieve::factory(10)->create();
            // VoteAnswer::factory(10)->create(); 
            // VoteQuestion::factory(10)->create();         
        // \App\Models\User::factory(10)->create();
    }
}
