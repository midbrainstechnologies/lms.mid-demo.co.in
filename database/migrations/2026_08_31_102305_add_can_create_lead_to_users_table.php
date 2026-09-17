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
        Schema::table('users', function (Blueprint $table) {
            // Per-user toggle: lets Admin/Business owner allow a Telecaller
            // to create leads themselves, same as a Lead Creator can.
            $table->enum('can_create_lead', ['0', '1'])
                ->default('0')
                ->after('user_role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('can_create_lead');
        });
    }
};
