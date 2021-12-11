<?php

namespace Database\Factories;

use App\Models\Badge;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BadgeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Badge::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->word(3, true);
        return [
            //
            'name' => $name,
            'slug' => Str::slug($name),
            'type' => $this->faker->word(3, true),
            'score' => $this->faker->numberBetween(1,60)
        ];
    }
}
