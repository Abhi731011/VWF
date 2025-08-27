<?php

namespace App\Http\Controllers\landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing.main');
    }
    public function contact()
    {
        return view('landing.contact.contact');
    }
    public function about()
    {
        return view('landing.about.index');
    }
    public function services()
    {
        return view('landing.services.index');
    }
}
