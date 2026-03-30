<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Job;
use App\Models\Location;
use App\Models\Category;
use App\Models\Designation;


class JobController extends Controller
{
    


    public function index()
    {
    
    $data['jobs'] = Job::with(['company','locations'])->latest()->get();

    return view('jobs',$data);

    }


    public function detail($slug)
    {

        $job = Job::with(['company','designation'])
                ->where('id',$slug)
                ->where('is_active',1)
                ->firstOrFail();

        $locationAllowed = true;

        if(auth('employee')->check()){

        $employee = auth('employee')->user();

        $locationAllowed = $job->locations()
                                ->whereIn('location_id', [
                                    $employee->location_1,
                                    $employee->location_2
                                ])
                                ->exists();
        }

        $related = Job::where('designation_id',$job->designation_id)
                        ->where('id','!=',$job->id)
                        ->where('is_active',1)
                        ->latest()
                        ->limit(6)
                        ->get();

        return view('job-detail',compact('job','related'));

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


    public function locationsByDesignation($designationId)
    {
        $designation = Designation::with('locations')->findOrFail($designationId);

        if($designation->all_locations)
        {
            $locations = Location::orderBy('name')->get(['id','name']);
        }
        else
        {
            $locations = $designation->locations()
                ->orderBy('name')
                ->get(['locations.id','locations.name']);
        }

        return response()->json($locations);
    }



}
