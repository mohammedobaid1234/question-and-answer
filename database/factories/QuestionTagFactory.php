<?php

namespace Database\Factories;

use App\Models\TagQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
class QuestionTagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TagQuestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $res= DB::table('questions')->inRandomOrder()->limit(1)->first(['id']);
        $res1= DB::table('tags')->inRandomOrder()->limit(1)->first(['id']);

        return [
            'question_id' => $res,
            'tag_id' => $res1
        ];
    }
}
