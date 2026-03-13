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

        return view('employee.index',compact(
            'applications',
            'application_count',
            'employee'
        ));
    }
}