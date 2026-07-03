<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class JobPostFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->jobTitle();
        $salaryMin = $this->faker->numberBetween(150000, 250000);

        return [
            // === CÁC TRƯỜNG BẮT BUỘC ===
            'title' => $title,
            'slug' => Str::slug($title) . '-' . uniqid(),
            'description' => $this->faker->paragraphs(3, true),
            'status' => $this->faker->randomElement(['draft', 'published', 'closed', 'expired']),
            'destination_country' => $this->faker->randomElement(['JP', 'KR', 'TW', 'SG']),
            'job_type' => $this->faker->randomElement(['full_time', 'part_time', 'contract', 'internship']),
            'visa_type' => $this->faker->randomElement(['tokutei', 'ginou_jisshu', 'other']),
            'headcount' => $this->faker->numberBetween(1, 50),
            'created_by' => 1,

            // === CÁC TRƯỜNG NULLABLE ===
            'category_id' => $this->faker->optional(0.7)->numberBetween(1, 10),
            'requirements' => $this->faker->optional(0.8)->paragraph(),
            'benefits' => $this->faker->optional(0.8)->paragraph(),
            'work_location' => $this->faker->optional(0.9)->city(),
            
            // Thông tin Lương (ĐÃ FIX LỖI Ở ĐÂY)
            'salary_min' => $this->faker->optional(0.7)->randomElement([$salaryMin, null]),
            'salary_max' => $this->faker->optional(0.7)->randomElement([$salaryMin + $this->faker->numberBetween(20000, 50000), null]),
            'salary_currency' => $this->faker->optional(0.7)->randomElement(['JPY', 'USD', 'VND']),
            'salary_period' => $this->faker->optional(0.7)->randomElement(['monthly', 'hourly', 'yearly']),
            
            // Yêu cầu Ứng viên
            'experience_years_min' => $this->faker->optional(0.5)->numberBetween(0, 5),
            'age_min' => $this->faker->optional(0.6)->numberBetween(18, 22),
            'age_max' => $this->faker->optional(0.6)->numberBetween(30, 45),
            'gender_preference' => $this->faker->optional(0.5)->randomElement(['male', 'female', 'any']),
            
            // Thời gian
            'published_at' => $this->faker->optional(0.7)->dateTimeBetween('-1 month', 'now'),
            'expired_at' => $this->faker->optional(0.5)->dateTimeBetween('now', '+2 months'),
            
            // === CÁC TRƯỜNG CÓ DEFAULT VALUE ===
            'is_featured' => $this->faker->boolean(20),
            'view_count' => $this->faker->numberBetween(0, 2000),
            'application_count' => $this->faker->numberBetween(0, 150),
        ];
    }
}