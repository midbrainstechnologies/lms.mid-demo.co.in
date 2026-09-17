<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Widen the enum first so it accepts both the old and new values at once - the
        // column can't hold 'hot' etc. until this runs, so writing new values before it
        // would truncate/reject them under strict mode.
        DB::statement("ALTER TABLE lead_management MODIFY lead_type ENUM('new','t_approve','t_process','t_hot','t_complete','callback','ringing','switchoff','t_delete','a_approve','a_process','a_complete','hot','warm','cold','dead','closed') NOT NULL DEFAULT 'new'");

        // Fold the old telecaller workflow states into the new marking set before narrowing
        // the enum, so no existing row is left holding a value the new enum can't store.
        // 'closed' (green/won) replaces t_complete as the signal that hands a lead to Admin's
        // billing pipeline; a_process/a_complete (billing progress) are untouched.
        DB::table('lead_management')->where('lead_type', 't_hot')->update(['lead_type' => 'hot']);
        DB::table('lead_management')->where('lead_type', 't_complete')->update(['lead_type' => 'closed']);
        DB::table('lead_management')->where('lead_type', 't_delete')->update(['lead_type' => 'dead']);
        DB::table('lead_management')->whereIn('lead_type', ['t_approve', 't_process', 'callback', 'ringing', 'switchoff', 'a_approve'])->update(['lead_type' => 'new']);

        // Now narrow the enum down to just what the app writes going forward.
        DB::statement("ALTER TABLE lead_management MODIFY lead_type ENUM('new','hot','warm','cold','dead','closed','a_process','a_complete') NOT NULL DEFAULT 'new'");

        // The separate hot/warm/cold/dead column on the All Leads tab is now redundant;
        // lead_type carries the same markings for every panel.
        if (Schema::hasColumn('lead_management', 'lead_temperature')) {
            Schema::table('lead_management', function (Blueprint $table) {
                $table->dropColumn('lead_temperature');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lead_management', function (Blueprint $table) {
            $table->enum('lead_temperature', ['none', 'hot', 'warm', 'cold', 'dead'])
                ->default('none')
                ->after('lead_type');
        });

        DB::statement("ALTER TABLE lead_management MODIFY lead_type ENUM('callback','ringing','switchoff','new','t_approve','t_delete','t_process','t_hot','t_complete','a_approve','a_process','a_complete') NOT NULL DEFAULT 'new'");
    }
};
