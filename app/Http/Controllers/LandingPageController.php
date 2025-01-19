<?php

namespace App\Http\Controllers;

class LandingPageController extends Controller
{


    public function index()
    {
        return view('landing-page.index');

    }//end index()


    public function store()
    {
        dd('Storing!');

    }//end store()


}
