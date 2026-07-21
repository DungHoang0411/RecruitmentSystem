<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Company;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Company::truncate();
        Tag::truncate();
        Schema::enableForeignKeyConstraints();

        $categories = ['IT Phần mềm', 'Kế toán', 'Marketing', 'Nhân sự', 'Kinh doanh', 'Thiết kế đồ họa'];

        foreach ($categories as $cat) {
            Category::create([
                'name' => 'category_' . $cat,
                'slug' => 'category_' . Str::slug($cat, '_')
            ]);
        }

        $companies = ['FPT Software', 'Viettel', 'VNG Corporation', 'Shopee', 'Tiki', 'Techcombank'];

        foreach ($companies as $comp) {
            Company::create([
                'name' => 'company_' . $comp,
                'slug' => 'company_' . Str::slug($comp, '_'),
                'description' => 'Môi trường làm việc chuyên nghiệp tại ' . $comp
            ]);
        }

        $tags = ['Backend', 'Frontend', 'Tiếng Nhật', 'Tiếng Anh', 'Làm việc từ xa', 'Thực tập sinh', 'Quản lý'];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => 'tag_' . $tag,
                'slug' => 'tag_' . Str::slug($tag, '_')
            ]);
        }
    }
}
