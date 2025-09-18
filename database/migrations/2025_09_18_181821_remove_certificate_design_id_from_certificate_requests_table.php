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
        Schema::table('certificate_requests', function (Blueprint $table) {
            $table->dropColumn('certificate_design_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('certificate_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('certificate_design_id')->nullable()->after('certificate_path');
            $table->foreign('certificate_design_id')->references('id')->on('certificate_designs')->onDelete('set null');
        });
    }
};