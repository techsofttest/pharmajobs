<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class RegisterTypeController extends Controller
{
    public function index()
    {
        return view('auth.register-type'); // choose account type page
    }

    public function redirect($type)
    {
        return match ($type) {
            'employee' => redirect()->route('employee.register'),
            'employer' => redirect()->route('employer.register'),
            default => abort(404),
        };
    }
}