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

            // Basic info
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('short_description', 255)->nullable();
            $table->longText('description')->nullable();

            // Categorization
            $table->unsignedBigInteger('category_id')->nullable();
            $table->json('tags')->nullable(); // store tags as JSON array

            // Media
            $table->json('images')->nullable(); // store array of image paths
            $table->string('video_url')->nullable();
            $table->string('video_file')->nullable();

            // Donation settings
            $table->decimal('target_amount', 12, 2)->nullable();
            $table->decimal('min_donation', 12, 2)->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_recurring')->nullable();

            // Organizer
            $table->string('organizer_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();

            // Status & visibility
            $table->enum('status', ['draft', 'published', 'archived'])->nullable();
            $table->boolean('is_featured')->nullable();
            $table->boolean('visibility')->nullable(); // 1 = public, 0 = private

            // Optional extras
            $table->string('location')->nullable();
            $table->json('documents')->nullable(); // store file paths
            $table->json('faqs')->nullable(); // question-answer pairs as JSON
            $table->json('updates')->nullable(); // announcements as JSON

            $table->timestamps();
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
