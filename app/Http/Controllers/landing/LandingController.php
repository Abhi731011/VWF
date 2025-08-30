<?php

namespace App\Http\Controllers\landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;

class LandingController extends Controller
{
    public function index()
    {
        try {
            $projects = Project::with('category')->get();
        } catch (\Exception $e) {
            $projects = collect([]); // Empty collection if there's an error
        }

        // Ensure projects is always a collection
        if (!$projects) {
            $projects = collect([]);
        }

        return view('landing.main', compact('projects'));
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
  public function causes()
    {
        $projects = Project::with('category')->get();
        return view('landing.causes.index', compact('projects'));
    }
    public function events()
    {
        return view('landing.events.index');
    }
}
