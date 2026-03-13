<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
   

    public function edit()
    {
        $employee = auth('employee')->user()->load([
        'employee.category',
        'employee.designation',
        'employee.locations'
        ]);

        return view('employee.profile.edit', compact('employee'));
    }


    public function update(Request $request)
    {
    $profile = auth('employee')->user();

    $data = $request->validate([
        'first_name' => 'required',
        'last_name'  => 'required',
        'phone'      => 'required',
        'speciality' => 'nullable|string',
        'yoe'        => 'nullable|string',
        'qualification' => 'nullable|string',
        'cv'         => 'nullable|mimes:pdf,doc,docx|max:2048',
        'password'   => 'nullable|confirmed|min:6'
    ]);

    /* Resume Upload */
    if ($request->hasFile('cv')) {
        $data['cv'] = $request->file('cv')->store('resumes', 'public');
    }

    /* Update Employee Table */
    $profile->update([
        'first_name' => $data['first_name'],
        'last_name'  => $data['last_name'],
        'phone'      => $data['phone']
    ]);

    /* Update Profile Employee Table */
    if ($profile->employee) {
        $profile->employee->update([
            'speciality' => $data['speciality'] ?? null,
            'qualification' => $data['qualification'] ?? null,
            'yoe'        => $data['yoe'] ?? null,
            'cv'         => $data['cv'] ?? $profile->employee->cv,
        ]);
    }

    return back()->with('success','Profile updated successfully');
    }



    public function changePassword()
    {
        return view('employee.profile.change-password');
    }

    public function updatePassword(Request $request)
    {
        $employee = auth('employee')->user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        if (!Hash::check($request->current_password, $employee->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $employee->update([
            'password' => bcrypt($request->password)
        ]);

        return back()->with('success','Password updated successfully');
    }






}
