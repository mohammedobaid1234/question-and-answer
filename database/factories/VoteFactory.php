<?php

namespace Database\Factories;

use App\Models\Vote;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
class VoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vote::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $res= DB::table('users')->inRandomOrder()->limit(1)->first(['id']);
        return [
            'user_id' => $res->id,
            'votes' => $this->faker->numberBetween(0,600),
        ];
    }
}
