<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use App\Models\Business;

class CheckPlanExpiry
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
{
    $user = auth()->user();

    if ($user && $user->user_role === 'admin' && $user->business_id) {
        $business = Business::find($user->business_id);

        if ($business && $business->plan_end_date) {
            $endDate = Carbon::parse($business->plan_end_date);
            $today   = Carbon::today();

            if ($today->equalTo($endDate->copy()->subDay()) ||
                $today->equalTo($endDate->copy()->subDays(2))) {
                session()->flash('plan_warning', 'Your subscription plan is expiring soon. Please contact the owner.');
            }
        }
    }

    return $next($request);
}
}
