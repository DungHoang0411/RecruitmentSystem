<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('job_posts', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('department');
        $table->decimal('salary_min', 10, 2)->nullable();
        $table->decimal('salary_max', 10, 2)->nullable();
        $table->date('deadline');
        $table->string('status')->default('active'); // active, closed, etc.
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
