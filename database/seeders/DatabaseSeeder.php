<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Company;
use App\Models\Tag;
use App\Models\JobPost;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tạo tài khoản Leader Admin (Đã thêm xác thực email để test luôn)
        User::factory()->create([
            'name' => 'Leader Admin',
            'email' => 'leader@recruitment.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        // 2. Tạo dữ liệu tĩnh (Danh mục, Công ty, Tag)
        Category::factory(5)->create();
        Company::factory(5)->create();
        Tag::factory(10)->create();

        // 3. Tạo 20 JobPost và gắn Tag ngẫu nhiên
        JobPost::factory(20)->create()->each(function ($job) {
            $tags = Tag::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $job->tags()->attach($tags);
        });
    }
}
