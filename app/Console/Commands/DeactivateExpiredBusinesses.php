<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Business;
use Carbon\Carbon;

class DeactivateExpiredBusinesses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'business:deactivate-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate businesses whose subscription end date has passed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expired = Business::where('status', '!=', 'inactive')
            ->whereDate('plan_end_date', '<', Carbon::today())
            ->update(['status' => 'inactive']);
            
            // \Log::info("Cron ran: $expired businesses marked inactive at " . now());


        $this->info("$expired businesses marked as inactive.");
    }
}
