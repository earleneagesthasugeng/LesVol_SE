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
        Schema::table('activities', function (Blueprint $table) {
            $table->string('status')->default('active')->after('slot');
            // status values: 'active', 'done'
        });

        Schema::table('volunteers', function (Blueprint $table) {
            $table->string('proof_path')->nullable()->after('file_att_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('volunteers', function (Blueprint $table) {
            $table->dropColumn('proof_path');
        });
    }
};
