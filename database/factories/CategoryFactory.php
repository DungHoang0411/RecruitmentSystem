<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition()
    {
        $name = $this->faker->unique()->word() . ' ' . rand(1, 100);
        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
        ];
    }
}
