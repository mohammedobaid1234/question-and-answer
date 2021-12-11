<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = ['active','draft','pending'];
        $group_id = ['user','admin'];
        $name = $this->faker->name();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' =>Hash::make('123456'), // password
            'major' => $this->faker->jobTitle(),
            'birth_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'votes' => 0,
            'status'  => $status[rand(0,2)], 
            'group_id' =>$group_id[rand(0,1)],
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
