<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompanyFactory extends Factory
{
    public function definition()
    {
        $name = $this->faker->unique()->company();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(),
        ];
    }
}
