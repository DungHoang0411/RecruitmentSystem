<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::table('job_posts', function (Blueprint $table) {
        // 1. Tạo cột trước
        $table->unsignedBigInteger('category_id')->nullable();
        $table->unsignedBigInteger('company_id')->nullable();

        // 2. Định nghĩa khóa ngoại sau
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
    });
}
};
