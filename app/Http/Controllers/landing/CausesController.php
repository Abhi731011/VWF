<?php

namespace App\Http\Controllers\landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class CausesController extends Controller
{
    public function index()
    {
        $projects = Project::with('category')
        ->where('status', 'published')
        ->get();
        return view('landing.causes.index', compact('projects'));
    }

    public function show(Project $project)
    {
        // Add some debugging
        \Log::info('Project found: ' . $project->title . ' with slug: ' . $project->slug);
        
        return view('landing.causes.show', compact('project'));
    }
}
