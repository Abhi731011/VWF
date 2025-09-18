<?php

namespace App\Http\Controllers\landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\User;

class LandingController extends Controller
{
    public function index()
    {
        try {
            $projects = Project::with('category')
            ->where('status', 'published')
            ->where('visibility', true)
            
            ->get();
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

        // Get footer data
        $footerData = $this->getFooterData();

        return view('landing.main', compact('projects', 'events', 'footerData'));

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

    public function gallery()
    {
        $galleries = Gallery::where('status', true)
            // ->orderBy('sort_order')
            ->get();
            
        return view('landing.gallery.index', compact('galleries'));
    }

    /**
     * Get footer data including gallery images and events
     */
    public function getFooterData()
    {
        try {
            // Get latest 6 gallery images for footer
            $galleryImages = collect();
            Gallery::where('status', true)
                ->whereNotNull('images')
                ->get()
                ->each(function ($gallery) use (&$galleryImages) {
                    foreach ($gallery->images as $imageData) {
                        if (isset($imageData['image'])) {
                            $galleryImages->push(asset($imageData['image']));
                        }
                    }
                });
            
            $galleryImages = $galleryImages->take(6)->values();

            // Get ongoing programs (projects) for programs section
            $ongoingPrograms = Project::where('status', 'published')
                ->where('visibility', true)
                ->latest()
                ->limit(5)
                ->get(['id', 'title', 'slug']);

            // Get top 5 ongoing events for footer
            $ongoingEvents = Event::where('status', 'published')
                ->where('visibility', true)
                ->where('event_date', '>=', now())
                ->orderBy('event_date', 'asc')
                ->limit(5)
                ->get(['id', 'title', 'slug', 'event_date']);

            // Get recent volunteers (users) for volunteer section
            $recentVolunteers = User::latest()
                ->limit(6)
                ->get(['id', 'name']);

            return [
                'gallery_images' => $galleryImages,
                'ongoing_programs' => $ongoingPrograms,
                'ongoing_events' => $ongoingEvents,
                'recent_volunteers' => $recentVolunteers,
            ];
        } catch (\Exception $e) {
            \Log::error('Footer data error: ' . $e->getMessage());
            
            return [
                'gallery_images' => [],
                'ongoing_programs' => [],
                'ongoing_events' => [],
                'recent_volunteers' => [],
            ];
        }
    }
}
