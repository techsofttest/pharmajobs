<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\ProfileEmployer;
use App\Models\Company;

class RegisterController extends Controller
{
    public function create()
    {
        $companies = Company::where('is_active', true)->orderBy('name')->get();

        return view('employer.auth.register', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:profiles,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|confirmed|min:6',
            
            'company_id' => 'required|exists:companies,id',
            'designation' => 'required|in:hr,manager',
        ]);

        $profile = DB::transaction(function () use ($request) {

            $profile = Profile::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'employer',
                'is_active' => 1,
            ]);

            ProfileEmployer::create([
                'profile_id' => $profile->id,
                'company_id' => $request->company_id,
                'designation' => $request->designation,
            ]);

            return $profile;
        });

        Auth::guard('employer')->login($profile);

        // event(new \Illuminate\Auth\Events\Registered($profile));

        return redirect()->route('employer.dashboard');
    }
}
