<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Job;
use App\Models\Location;
use App\Models\Category;
use App\Models\Designation;


class JobController extends Controller
{
    

    public function index(Request $request)
    {
    
    $query = Job::with(['company','locations'])->active();

    if($request->designation)
        $query->where('designation_id', $request->designation);

    if($request->location)
        $query->whereHas('locations', function($q) use ($request){
            $q->where('location_id', $request->location);
        });

    $data['jobs'] = $query->latest()->get();

    $data['recommended_jobs'] = null;
    if (auth()->guard('employee')->check()) {
        $data['recommended_jobs'] = Job::active()
            ->recommended(auth()->guard('employee')->user())
            ->with(['company', 'locations'])
            ->latest()
            ->get();
    }

    $data['categories'] = Category::orderBy('name')->get();

    return view('jobs',$data);

    }

    public function detail($slug)
    {

        $job = Job::with(['company','designation','locations'])
                ->where('id',$slug)
                ->where('is_active',1)
                ->firstOrFail();

        // ── Access-control flags (defaults for guests / employers) ──
        $locationAllowed    = false;
        $designationAllowed = false;
        $hasSubscription    = false;
        $isEmployee         = auth('employee')->check();
        $isEmployer         = auth('employer')->check();

        if ($isEmployee) {

            $employee = auth('employee')->user();
            $profile  = $employee;
            $empProfile = $employee->employee; // ProfileEmployee

            // 1) Location check — job must be in one of the employee's 2 locations
            $employeeLocationIds = $empProfile->locations->pluck('id')->toArray();
            $jobLocationIds      = $job->locations->pluck('id')->toArray();
            $locationAllowed     = count(array_intersect($employeeLocationIds, $jobLocationIds)) > 0;

            // 2) Designation check — job must match the employee's registered designation
            $designationAllowed = ($empProfile->designation_id == $job->designation_id);

            // 3) Subscription check — employee must have an active subscription
            $hasSubscription = $profile->activeSubscription !== null;
        }

        // Employers can always see full details
        if ($isEmployer) {
            $locationAllowed    = true;
            $designationAllowed = true;
            $hasSubscription    = true;
        }

        // The job detail is fully unlocked only when all 3 conditions are met
        $canViewFullDetails = $locationAllowed && $designationAllowed && $hasSubscription;

        $related = Job::where('designation_id',$job->designation_id)
                        ->where('id','!=',$job->id)
                        ->where('is_active',1)
                        ->latest()
                        ->limit(6)
                        ->get();

        return view('job-detail', compact(
            'job',
            'related',
            'locationAllowed',
            'designationAllowed',
            'hasSubscription',
            'canViewFullDetails',
            'isEmployee',
            'isEmployer'
        ));

    }


    public function search(Request $request)
    {
        $jobs = Job::query();

        $categories = Category::orderBy('name')->get();

       
        if($request->designation)
            $jobs->where('designation_id',$request->designation);

        if($request->location)
            $jobs->whereHas('locations', function($q) use ($request){
                $q->where('location_id',$request->location);
            });

        $jobs = $jobs->latest()->paginate(20);

        return view('search', compact('jobs','categories'));
    }


    public function designationsByCategory($categoryId)
    {
        $designations = Designation::where('category_id',$categoryId)
            ->orderBy('name')
            ->get(['id','name']);

        return response()->json($designations);
    }


    public function locationsByDesignation(Request $request, $designationId)
    {
        $designation = Designation::with('locations')->findOrFail($designationId);

        $query = $designation->all_locations ? Location::query() : $designation->locations();

        if ($request->has('q') && $request->q != '') {
            $query->where('locations.name', 'like', '%' . $request->q . '%');
        }

        $locations = $query->orderBy('locations.name')
            ->get(['locations.id', 'locations.name']);

        return response()->json($locations);
    }



}
