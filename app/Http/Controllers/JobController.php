<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Job;

class JobController extends Controller
{
    


    public function index()
    {
    
    $data['jobs'] = Job::with(['company','districts'])->latest()->get();

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



}
