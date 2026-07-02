<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JobPostFactory extends Factory
{
    public function definition(): array
    {
     
        $salary_min = $this->faker->numberBetween(10, 20) * 1000000; 

        return [
            'title' => $this->faker->jobTitle(),
            'department' => $this->faker->randomElement(['IT', 'HR', 'Marketing', 'Sales']),
            
            'salary_min' => $salary_min,
            'salary_max' => $salary_min + $this->faker->numberBetween(5, 15) * 1000000, 
            
            'deadline' => $this->faker->dateTimeBetween('-1 month', '+2 months')->format('Y-m-d'),
            
            'status' => $this->faker->randomElement(['active', 'closed', 'draft']),
        ];
    }
}