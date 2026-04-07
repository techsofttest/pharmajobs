<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;

class PolicyController extends Controller
{
    

    public function terms()
    {
    
    $data['content'] = Page::where('id',2)->first();

    return view('cms',$data);

    }


    public function privacy()
    {
    
    $data['content'] = Page::where('id',3)->first();

    return view('cms',$data);

    }



    public function disclaimer()
    {
    
    $data['content'] = Page::where('id',4)->first();

    return view('cms',$data);

    }



    public function refund()
    {
    
    $data['content'] = Page::where('id',5)->first();

    return view('cms',$data);

    }






}
