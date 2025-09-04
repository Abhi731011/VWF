<?php

namespace App\Http\Controllers\landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;
use App\Models\Event;

class LandingController extends Controller
{
    public function index()
    {
        try {
            $projects = Project::with('category')->where('status', 'published')->get();
        } catch (\Exception $e) {
            $projects = collect([]); // Empty collection if there's an error
        }

        // Ensure projects is always a collection
        if (!$projects) {
            $projects = collect([]);
        }

        try {
            $events = Event::with('category')
                ->where('status', 'published')
                ->where('visibility', true)
                ->latest('event_date')
                ->limit(4)
                ->get();
        } catch (\Exception $e) {
            $events = collect([]); // Empty collection if there's an error
        }

        // Ensure events is always a collection
        if (!$events) {
            $events = collect([]);
        }

        return view('landing.main', compact('projects', 'events'));
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
        $projects = Project::with('category')
            ->where('status', 'published')
            ->get();
        return view('landing.causes.index', compact('projects'));
    }
    public function events()
    {
        $events = Event::latest()
        ->where('status', 'published')
        ->where('visibility', true)
        ->get();
            // ->orderBy('event_date', 'asc')
            // ->limit(6)
            // ->get();
// dd($events);
        return view('landing.events.index', compact('events'));
    }

    public function showEvent(Event $event)
    {
        // Add some debugging
        \Log::info('Event found: ' . $event->title . ' with slug: ' . $event->slug);
        
        return view('landing.events.show', compact('event'));
    }
}
