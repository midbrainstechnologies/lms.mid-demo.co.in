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
        // Holds only the telecaller's own typed note, separate from the auto-generated
        // sentence in `remarks` ("Lead Marked <b>Hot</b> by remarks:- ..."), so the All
        // Leads follow-up columns can show just what was actually typed.
        Schema::table('lead_status', function (Blueprint $table) {
            $table->text('followup_note')->nullable()->after('remarks');
        });

        // Backfill: pull the typed portion out of existing "... by remarks:- {note}" rows
        // so historical follow-ups don't disappear from the All Leads table.
        DB::table('lead_status')->where('remarks', 'like', '%by remarks:-%')->orderBy('id')->chunkById(200, function ($rows) {
            foreach ($rows as $row) {
                $marker = 'by remarks:- ';
                $pos = strpos($row->remarks, $marker);
                if ($pos !== false) {
                    $note = trim(substr($row->remarks, $pos + strlen($marker)));
                    if ($note !== '') {
                        DB::table('lead_status')->where('id', $row->id)->update(['followup_note' => $note]);
                    }
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lead_status', function (Blueprint $table) {
            $table->dropColumn('followup_note');
        });
    }
};
