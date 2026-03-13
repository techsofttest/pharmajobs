<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\HomeBanner;
use App\Models\Job;
use App\Models\Category;
use App\Models\Package;
use App\Models\State;
use App\Models\District;

class HomeController extends Controller
{
    


    public function index()
    {

    $data['banners'] = HomeBanner::all();

    $data['states'] = State::orderBy('name')->get();

    $data['categories'] = Category::orderBy('name','asc')->get();

    $data['packages'] = Package::with('category.designations')->get();

    $data['jobs'] = Job::active()->with(['company','districts'])->latest()->get();

    return view('index',$data);

    }



}
