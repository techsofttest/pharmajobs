<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobApplication;

class JobApplicationController extends Controller
{
    


    public function apply(Request $request, $id)
    {
    $employee = auth('employee')->user();

    $job = Job::findOrFail($id);

    // Handle resume upload if provided
    if ($request->hasFile('resume')) {
        $request->validate([
            'resume' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $path = $request->file('resume')->store('resumes', 'public');
        
        $employee->employee()->update([
            'cv' => $path
        ]);
    }

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

    // Send Notifications
    $adminEmail = env('ADMIN_EMAIL', config('mail.from.address'));
    $creator = $job->createdBy; // Profile model
    $posterDesignation = $creator->employer->designation ?? null;

    try {
        // Always notify admin
        \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\JobApplicationNotificationMail($job, $employee));

        // If HR, also notify the HR poster
        if ($posterDesignation === 'hr' && $creator->email) {
            \Illuminate\Support\Facades\Mail::to($creator->email)->send(new \App\Mail\JobApplicationNotificationMail($job, $employee));
        }
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error('Job application mail error: ' . $e->getMessage());
    }

    $message = 'Application submitted successfully';
    
    // Check if the job was posted by an employer and if their designation is HR
    $creator = $job->createdBy;
    if ($creator && $creator->employer?->designation !== 'hr') {
        $message = 'Contact details unlocked successfully';
    }

    return back()->with('success', $message);
    }



}
