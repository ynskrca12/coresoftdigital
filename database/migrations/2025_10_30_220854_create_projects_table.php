<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category');
            $table->text('description');
            $table->text('long_description')->nullable();
            $table->string('duration'); // 6 Ay, 3 Ay, etc.
            $table->year('year');
            $table->enum('status', ['in_progress', 'completed', 'on_hold'])->default('in_progress');
            $table->string('image')->nullable();
            $table->json('gallery')->nullable(); // Multiple images
            $table->string('url')->nullable(); // Live project URL
            $table->integer('order')->default(0); // Display order
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('slug');
            $table->index('category');
            $table->index('status');
            $table->index('active');
            $table->index('year');
            $table->index('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
