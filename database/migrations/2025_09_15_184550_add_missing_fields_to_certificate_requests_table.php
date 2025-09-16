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
            if (!Schema::hasColumn('certificate_requests', 'rejection_reason')) {
                $table->text('rejection_reason')->nullable()->after('status');
            }
            if (!Schema::hasColumn('certificate_requests', 'approved_at')) {
                $table->timestamp('approved_at')->nullable()->after('rejection_reason');
            }
            if (!Schema::hasColumn('certificate_requests', 'rejected_at')) {
                $table->timestamp('rejected_at')->nullable()->after('approved_at');
            }
            if (!Schema::hasColumn('certificate_requests', 'approved_by')) {
                $table->unsignedBigInteger('approved_by')->nullable()->after('rejected_at');
            }
            if (!Schema::hasColumn('certificate_requests', 'rejected_by')) {
                $table->unsignedBigInteger('rejected_by')->nullable()->after('approved_by');
            }
            if (!Schema::hasColumn('certificate_requests', 'certificate_path')) {
                $table->string('certificate_path')->nullable()->after('rejected_by');
            }
            if (!Schema::hasColumn('certificate_requests', 'certificate_design_id')) {
                $table->unsignedBigInteger('certificate_design_id')->nullable()->after('certificate_path');
            }
        });
        
        // Add foreign key constraints
        Schema::table('certificate_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('certificate_requests', 'approved_by')) {
                $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            }
            if (!Schema::hasColumn('certificate_requests', 'rejected_by')) {
                $table->foreign('rejected_by')->references('id')->on('users')->onDelete('set null');
            }
            if (!Schema::hasColumn('certificate_requests', 'certificate_design_id')) {
                $table->foreign('certificate_design_id')->references('id')->on('certificate_designs')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('certificate_requests', function (Blueprint $table) {
            $table->dropForeign(['approved_by']);
            $table->dropForeign(['rejected_by']);
            $table->dropForeign(['certificate_design_id']);
            $table->dropColumn([
                'rejection_reason', 'approved_at', 'rejected_at', 
                'approved_by', 'rejected_by', 'certificate_path', 'certificate_design_id'
            ]);
        });
    }
};
