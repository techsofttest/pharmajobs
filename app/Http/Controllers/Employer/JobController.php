<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Designation;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class JobController extends Controller
{

    public function index()
    {    
        $employer = Auth::guard('employer')->user();

        $jobs = Job::where('created_by_type', $employer->getMorphClass())
                ->where('created_by_id', $employer->id)
                ->latest()
                ->get();

        return view('employer.jobs.index', compact('jobs'));
    }


    public function show($id)
    {
        $employer = auth('employer')->user();

        $job = Job::with(['designation','districts','applications'])
            ->where('created_by_type', $employer->getMorphClass())
            ->where('created_by_id', $employer->id)
            ->findOrFail($id);

        return view('employer.jobs.view', compact('job'));
    }



    public function applicants($job_id)
    {
        $employer = auth('employer')->user();

        $job = Job::where('created_by_type',$employer->getMorphClass())
            ->where('created_by_id',$employer->id)
            ->with(['applications.employee.employee'])
            ->findOrFail($job_id);

        $applications = $job->applications;

        return view('employer.jobs.applicants',compact('job','applications'));
    }



    public function create()
    {
        $designations = Designation::all();
        $locations = Location::all();
         $categories = \App\Models\Category::all();

        return view('employer.jobs.create', compact(
            'designations',
            'locations',
            'categories'
        ));
    }


    public function store(Request $request)
    {
        $request->validate([

            'designation_id' => 'required|exists:designations,id',
            'title' => 'required|max:255',
            'description' => 'required',
            'qualification' => 'required',

            'districts' => 'required|array|max:12',
            'districts.*' => 'exists:districts,id',

            'contact_name' => 'required',
            'contact_email' => 'required|email',
            'contact_phone' => 'required',

            'min_experience' => 'nullable',
            'max_age' => 'nullable',
            'expires_at' => 'nullable|date',
        ]);

        $employer = Auth::guard('employer')->user();

        $job = Job::create([

            'company_id' => $employer->employer->company_id,
            'designation_id' => $request->designation_id,

            'job_id' => $request->job_id,

            'title' => $request->title,
            'description' => $request->description,
            'qualification' => $request->qualification,

            'contact_name' => $request->contact_name,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,

            'min_experience' => $request->min_experience,

            'max_age' => $request->max_age,

            'expires_at' => $request->expires_at,

            'is_active' => 0
            
        ]);

        $job->createdBy()->associate($employer);
        $job->save();

        $job->districts()->sync($request->districts);

        return redirect()
                ->route('employer.jobs.index')
                ->with('success', 'Job added successfully. It will be visible once admin approves');
    }


    public function edit(Job $job)
    {
        $employer = Auth::guard('employer')->user();

        // security check
        if ($job->created_by_id != $employer->id || $job->created_by_type !== get_class($employer)) {
            abort(403);
        }

        $designations = Designation::all();
        $locations = Location::all();

        $selectedlocations = $job->locations->pluck('id')->toArray();

        return view('employer.jobs.edit', compact(
            'job',
            'designations',
            'locations',
            'selectedlocations'
        ));
    }


    public function update(Request $request, Job $job)
    {
        $request->validate([

            'designation_id' => 'required|exists:designations,id',
            'title' => 'required|max:255',
            'description' => 'required',
            'qualification' => 'required',

            'districts' => 'required|array|max:12',
            'districts.*' => 'exists:districts,id',

            'contact_name' => 'required',
            'contact_email' => 'required|email',
            'contact_phone' => 'required',

            'min_experience' => 'nullable',
            'max_age' => 'nullable',
            'expires_at' => 'nullable|date',
        ]);

        $job->update([

            'designation_id' => $request->designation_id,
            'title' => $request->title,
            'description' => $request->description,
            'qualification' => $request->qualification,

            'contact_name' => $request->contact_name,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,

            'min_experience' => $request->min_experience,
            'max_age' => $request->max_age,

            'expires_at' => $request->expires_at,
        ]);

        $job->districts()->sync($request->districts);

        return redirect()
            ->route('employer.jobs.index')
            ->with('success', 'Job updated successfully');
    }




}