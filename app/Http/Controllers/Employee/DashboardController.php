<?php 

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Job;

use Illuminate\Database\Eloquent\Relations\MorphTo;

class DashboardController extends Controller
{
    public function index()
    {
        $employee = auth('employee')->user();

        $applications = $employee->applications()
                    ->with('job')
                    ->latest()
                    ->get();

        $application_count = $applications->count();
        
        $activeSubscription = null;
        if (\Illuminate\Support\Facades\Schema::hasTable('subscriptions')) {
            $activeSubscription = \App\Models\Subscription::where('profile_id', $employee->id)
                ->where('status', 'active')
                ->where('ends_at', '>', \Carbon\Carbon::now())
                ->with('package')
                ->latest('ends_at')
                ->first();
        }

        return view('employee.index',compact(
            'applications',
            'application_count',
            'employee',
            'activeSubscription'
        ));
    }
}