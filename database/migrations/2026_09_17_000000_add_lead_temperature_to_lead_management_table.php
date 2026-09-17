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
        Schema::table('lead_management', function (Blueprint $table) {
            // Telecaller-set temperature for a lead, shown as a colored badge/row on the All Leads list.
            $table->enum('lead_temperature', ['none', 'hot', 'warm', 'cold', 'dead'])
                ->default('none')
                ->after('lead_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lead_management', function (Blueprint $table) {
            $table->dropColumn('lead_temperature');
        });
    }
};
