<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('job_post_tag', function (Blueprint $table) {
        $table->id();
        $table->foreignId('job_post_id')->constrained('job_posts')->onDelete('cascade');
        $table->foreignId('tag_id')->constrained('tags')->onDelete('cascade');
    });
}
};
