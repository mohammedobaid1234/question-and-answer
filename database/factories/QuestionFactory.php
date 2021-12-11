<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = ['active','draft','pending'];
        $title = $this->faker->words(2,true);
        $res= DB::table('users')->inRandomOrder()->limit(1)->first(['id']);
        return [
            //
            'title' => $title,
            'body' => $this->faker->words(10, true),
            'slug' => Str::slug($title),
            'description' => $this->faker->words(10, true),
            'votes' => 0,
            'status'  => $status[rand(0,2)], 
            'user_id' => $res->id,
        ];
    }
}
