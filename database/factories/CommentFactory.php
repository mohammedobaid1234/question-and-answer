<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = ['active','draft','pending'];
        $res1= DB::table('users')->inRandomOrder()->limit(1)->first(['id']);
        $res2= DB::table('answers')->inRandomOrder()->limit(1)->first(['id']);
        $body= $this->faker->words(10, true);

        return [
            //
            'body' => $body,
            'slug' => Str::slug($body),
            'user_id'=>$res1->id,
            'answer_id'=> $res2->id,
        ];
    }
}
