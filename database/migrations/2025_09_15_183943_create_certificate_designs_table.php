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
        Schema::create('certificate_designs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('organization_name')->default('Vaishvik Welfare Foundation');
            $table->string('organization_logo')->nullable();
            $table->string('signature_image')->nullable();
            $table->string('signature_name')->nullable();
            $table->string('signature_title')->nullable();
            $table->string('background_color')->default('#ffffff');
            $table->string('border_color')->default('#000000');
            $table->string('text_color')->default('#000000');
            $table->string('title_color')->default('#000000');
            $table->string('organization_color')->default('#000000');
            $table->integer('border_width')->default(3);
            $table->string('font_family')->default('serif');
            $table->integer('title_font_size')->default(36);
            $table->integer('name_font_size')->default(28);
            $table->integer('organization_font_size')->default(18);
            $table->integer('signature_font_size')->default(16);
            $table->text('custom_css')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificate_designs');
    }
};
