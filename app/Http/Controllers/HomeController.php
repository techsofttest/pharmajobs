<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\HomeBanner;
use App\Models\Job;
use App\Models\Category;
use App\Models\Package;
use App\Models\State;
use App\Models\Location;

class HomeController extends Controller
{
    


    public function index()
    {

    $data['banners'] = HomeBanner::all();

    $data['states'] = State::orderBy('name')->get();

    $data['categories'] = Category::orderBy('order','asc')->get();

    $user = auth()->user() ?? auth()->guard('employee')->user() ?? auth()->guard('employer')->user();
    $categoryId = null;
    if (auth()->guard('employee')->check() && $user->employee) {
        $categoryId = $user->employee->category_id;
    }

    $packageQuery = Package::where('is_active', true);
    if ($categoryId) {
        $packageQuery->where('category_id', $categoryId);
    }
    $data['packages'] = $packageQuery->with('category.designations')->get();

    $data['jobs'] = Job::active()->with(['company','locations'])->latest()->get();

    $data['recommended_jobs'] = null;
    if (auth()->guard('employee')->check()) {
        $data['recommended_jobs'] = Job::active()
            ->recommended(auth()->guard('employee')->user())
            ->with(['company', 'locations'])
            ->latest()
            ->get();
    }

    return view('index',$data);

    }



}
