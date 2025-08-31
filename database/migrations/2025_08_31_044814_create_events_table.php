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
        Schema::create('events', function (Blueprint $table) {
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
            $table->json('banners')->nullable(); // store array of banner image paths

            // Event details
            $table->date('event_date')->nullable();
            $table->string('event_time')->nullable();
            $table->string('venue')->nullable();
            $table->string('location')->nullable();
            $table->longText('about_event')->nullable(); // mission, purpose
            $table->longText('agenda')->nullable();

            // Organizer
            $table->string('organizer_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();

            // Status & visibility
            $table->enum('status', ['draft', 'published', 'archived'])->nullable();
            $table->boolean('is_featured')->nullable();
            $table->boolean('visibility')->nullable(); // 1 = public, 0 = private

            // Registration settings
            $table->integer('max_attendees')->nullable();
            $table->boolean('registration_required')->nullable();
            $table->date('registration_deadline')->nullable();

            // Optional extras
            $table->json('documents')->nullable(); // store file paths
            $table->json('speakers')->nullable(); // speaker details as JSON
            $table->json('sponsors')->nullable(); // sponsor details as JSON

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
