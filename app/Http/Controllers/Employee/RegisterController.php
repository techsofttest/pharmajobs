<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        $categories = \App\Models\Category::all();
        $districts = \App\Models\District::orderBy('name','asc')->get();
        return view('employee.auth.register', compact('categories', 'districts'));
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
            'locations.*' => 'exists:districts,id',
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
                'speciality' => $request->speciality,
                'qualification' => $request->qualification,
                'yoe' => $request->yoe,
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