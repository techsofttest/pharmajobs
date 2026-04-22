<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Designation;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        $categories = \App\Models\Category::all();
        //$locations = \App\Models\Location::orderBy('name','asc')->get();
        return view('employee.auth.register', compact('categories'));
    }

public function locations(Request $request, $designationId)
{
    $designation = Designation::findOrFail($designationId);

    $locationsQuery = Location::query();

    if ($designation->all_locations != 1) {
        $locationsQuery->whereIn('locations.id', function($q) use ($designationId) {
            $q->select('location_id')
              ->from('designation_locations')
              ->where('designation_id', $designationId);
        });
    }

    if ($search = $request->q) {
        $locationsQuery->where('locations.name', 'like', "%{$search}%");
    }

    // ✅ select() BEFORE withCount()
    $locationsQuery->select('locations.id', 'locations.name');

    $locationsQuery->withCount([
        'jobs as jobs_count' => function ($q) use ($designationId) {
            $q->where('designation_id', $designationId);
        }
    ]);

    $locationsQuery->orderBy('locations.name', 'asc');

    $perPage = 20;
    $page = $request->page ?? 1;

    $paginated = $locationsQuery->paginate($perPage, ['*'], 'page', $page);

    return response()->json([
        'results' => $paginated->getCollection()->map(function ($loc) {
            return [
                'id'   => $loc->id,
                //'text' => $loc->name . ' (' . ($loc->jobs_count ?? 0) . ')',
                'text' => $loc->name . '(0)',
            ];
        }),
        'pagination' => [
            'more' => $paginated->hasMorePages(),
        ],
    ]);
}




    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:profiles,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|confirmed|min:6',
            'category_id' => 'required|exists:categories,id',
            'designation_id' => 'required|exists:designations,id',
            'qualification' => 'nullable|string|max:255',
            'speciality' => 'nullable|string|max:255',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'locations' => 'nullable|array|max:2',
            'locations.*' => 'exists:locations,id',
        ]);

        $profile = DB::transaction(function () use ($request) {

            // $employee User creation is currently confusing because we have Profile and ProfileEmployee tables.
            // As per requirements, we are using Profile/ProfileEmployee model structure.
            $profile = \App\Models\Profile::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'employee',
                'is_active' => 1,
            ]);

            // Handle CV upload
            $cvPath = null;
            if ($request->hasFile('cv')) {
                $cvPath = $request->file('cv')->store('cvs', 'public');
            }

            // Employee specific profile
            $profileEmployee = \App\Models\ProfileEmployee::create([
                'profile_id' => $profile->id,
                'category_id' => $request->category_id,
                'designation_id' => $request->designation_id,
                'cv' => $cvPath,
            ]);

            // Save Locations
            if ($request->has('locations') && is_array($request->locations)) {
                foreach ($request->locations as $district_id) {
                    \App\Models\EmployeeLocation::create([
                        'profile_employee_id' => $profileEmployee->id,
                        'district_id' => $district_id,
                    ]);
                }
            }

            return $profile;
        });

        // Auto login
        Auth::guard('employee')->login($profile);

        // Dispatch registered event to send email
        event(new \Illuminate\Auth\Events\Registered($profile));

        return redirect()->route('employee.dashboard');
        
    }
}