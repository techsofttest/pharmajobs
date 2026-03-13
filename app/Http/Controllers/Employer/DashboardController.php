<?php 

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;

use Illuminate\Database\Eloquent\Relations\MorphTo;

class DashboardController extends Controller
{
    public function index()
    {
        $employer = auth('employer')->user();

        $job_count = Job::where('created_by_type', $employer->getMorphClass())
                ->where('created_by_id', $employer->id)
                ->count();

        $jobs = Job::where('created_by_type', get_class($employer))
                ->where('created_by_id', $employer->id)
                ->latest()
                ->take(10)
                ->get();

        $active_jobs = Job::where('created_by_type', $employer->getMorphClass())
        ->where('created_by_id', $employer->id)
        ->where('is_active',1)
        ->count();

        $applicant_count = JobApplication::whereHas('job', function ($q) use ($employer) {
        $q->where('created_by_type', $employer->getMorphClass())
          ->where('created_by_id', $employer->id);
        })->count();

        $latest_applicants = JobApplication::with(['employee','job'])
        ->whereHas('job', function ($q) use ($employer) {
            $q->where('created_by_type', $employer->getMorphClass())
              ->where('created_by_id', $employer->id);
        })
        ->latest()
        ->take(10)
        ->get();

        return view('employer.index',compact(
            'job_count',
            'jobs',
            'active_jobs',
            'applicant_count',
            'latest_applicants'
        ));
    }
}