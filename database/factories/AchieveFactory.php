<?php

namespace Database\Factories;

use App\Models\Achieve;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
class AchieveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Achieve::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {  
        $res= DB::table('badges')->inRandomOrder()->limit(1)->first(['id']);
        return [
            'badge_id' => $res->id,
            'reputation' => $this->faker->numberBetween(0,600),
        ];
    }
}
