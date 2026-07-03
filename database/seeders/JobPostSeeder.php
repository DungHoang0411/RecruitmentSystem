<?php

namespace Database\Seeders;

use App\Models\JobPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class JobPostSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Đảm bảo hệ thống có ít nhất 1 User để gán vào trường created_by
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Người quản lý mẫu',
                'email' => 'admin@recruitment.com',
            ]);
        }

        // 2. Sinh ra đúng 20 bản ghi Job Post mẫu và gán ID của User trên vào
        JobPost::factory()->count(20)->create([
            'created_by' => $user->id
        ]);
    }
}