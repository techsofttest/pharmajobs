<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FAQ;

class FaqController extends Controller
{
    


    public function index()
    {

    $data['faq'] = FAQ::all();

    return view('faq',$data);

    }



}
