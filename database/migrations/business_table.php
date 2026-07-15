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
        $table->string('plan_name')->nullable();
        $table->date('plan_start_date')->nullable();
        $table->date('plan_end_date')->nullable();
        $table->decimal('price', 10, 2)->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
