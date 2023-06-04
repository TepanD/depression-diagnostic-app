<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformationPageController extends Controller
{
    /* 
    * Show the diagnostic page
    */
    public function show_information_page()
    {
        return view('information_page.index');
    }
}
