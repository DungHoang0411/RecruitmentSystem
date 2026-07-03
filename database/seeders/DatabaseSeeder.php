<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\JobPost;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Leader Admin',
            'email' => 'leader@recruitment.com',
            'password' => bcrypt('password'),
        ]);

        JobPost::factory(20)->create();
    }
}