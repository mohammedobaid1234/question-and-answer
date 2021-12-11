<?php

namespace Database\Factories;

use App\Models\Answer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class AnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Answer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = ['active','draft','pending'];
        $answer = $this->faker->words(10,true);
        $res= DB::table('users')->inRandomOrder()->limit(1)->first(['id']);
        $res1= DB::table('questions')->inRandomOrder()->limit(1)->first(['id']);
        return [
            //
            'body' => $this->faker->words(10, true),
            'slug' => Str::slug($answer),
            'votes' => rand(1,500),
            'status'  => $status[rand(0,2)], 
            'user_id' => $res->id,
            'question_id' => $res1->id
        ];
    }
}
