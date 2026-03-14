<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobApplication;

class JobApplicationController extends Controller
{
    


    public function apply($id)
    {
    $employee = auth('employee')->user();

    $job = Job::findOrFail($id);

    $alreadyApplied = JobApplication::where('job_posting_id',$job->id)
                        ->where('profile_id',$employee->id)
                        ->exists();

    if($alreadyApplied){
        return back()->with('error','You have already applied for this job');
    }

    JobApplication::create([
        'job_posting_id' => $job->id,
        'profile_id' => $employee->id
    ]);

    $message = 'Application submitted successfully';
    
    // Check if the job was posted by an employer and if their designation is HR
    $creator = $job->createdBy;
    if ($creator && $creator->employer?->designation !== 'hr') {
        $message = 'Contact details unlocked successfully';
    }

    return back()->with('success', $message);
    }



}
