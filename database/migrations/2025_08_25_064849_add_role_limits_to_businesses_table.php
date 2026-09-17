<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('businesses', function (Blueprint $table) {
        $table->unsignedInteger('lead_creator_limit')->default(1); // Default: 1 lead creator
        $table->unsignedInteger('telecaller_limit')->default(5);   // Default: 5 telecallers
    });
}

public function down()
{
    Schema::table('businesses', function (Blueprint $table) {
        $table->dropColumn(['lead_creator_limit', 'telecaller_limit']);
    });
}

};
