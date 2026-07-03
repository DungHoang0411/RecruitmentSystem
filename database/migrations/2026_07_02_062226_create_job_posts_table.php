<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_posts', function (Blueprint $table) {
            // === (NOT NULL) ===
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->enum('status', ['draft', 'published', 'closed', 'expired'])->default('draft');
            $table->string('destination_country'); // VD: JP, KR...
            $table->enum('job_type', ['full_time', 'part_time', 'contract', 'internship']);
            $table->enum('visa_type', ['tokutei', 'ginou_jisshu', 'other']);
            $table->integer('headcount');
            $table->unsignedBigInteger('created_by'); // Khóa ngoại liên kết với bảng users
            
            // ===  (NULLABLE) ===
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('requirements')->nullable();
            $table->text('benefits')->nullable();
            $table->string('work_location')->nullable();
            
            // Thông tin lương
            $table->decimal('salary_min', 15, 2)->nullable();
            $table->decimal('salary_max', 15, 2)->nullable();
            $table->string('salary_currency')->nullable(); // VD: JPY, USD, VND
            $table->string('salary_period')->nullable(); // VD: monthly, hourly
            
            // Yêu cầu ứng viên
            $table->integer('experience_years_min')->nullable();
            $table->integer('age_min')->nullable();
            $table->integer('age_max')->nullable();
            $table->enum('gender_preference', ['male', 'female', 'any'])->nullable();
            
            // Thời gian và Thống kê
            $table->timestamp('published_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->boolean('is_featured')->default(false)->nullable();
            $table->integer('view_count')->default(0)->nullable();
            $table->integer('application_count')->default(0)->nullable();

            // created_at, updated_at
            $table->timestamps(); 
            // deleted_at (Soft Deletes)
            $table->softDeletes(); 

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};