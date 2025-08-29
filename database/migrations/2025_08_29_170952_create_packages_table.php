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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0)->nullable();
            $table->string('currency', 10)->default('INR')->nullable();
            $table->string('duration_type')->default('monthly')->nullable(); // monthly, yearly etc.
            $table->integer('duration_value')->default(1)->nullable();
            $table->json('perks')->nullable(); // store array of perks
            $table->integer('goodies_count')->nullable();
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('is_featured')->default(false)->nullable();
            $table->boolean('status')->default(true)->nullable();
            $table->integer('sort_order')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
