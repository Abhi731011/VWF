<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('is_featured')) {
            $query->where('is_featured', $request->is_featured);
        }

        $events = $query->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $categories = \App\Models\Category::where('is_active', true)->get();
        return view('admin.events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags.*' => 'nullable|string',
            'banners.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_date' => 'nullable|date',
            'event_time' => 'nullable|string',
            'venue' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'about_event' => 'nullable|string',
            'agenda' => 'nullable|string',
            'organizer_name' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'status' => 'nullable|in:draft,archived,published',
            'is_featured' => 'nullable|boolean',
            'visibility' => 'nullable|boolean',
            'max_attendees' => 'nullable|integer|min:0',
            'registration_required' => 'nullable|boolean',
            'registration_deadline' => 'nullable|date',
            'documents.*' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'speakers.*.name' => 'nullable|string',
            'speakers.*.designation' => 'nullable|string',
            'speakers.*.bio' => 'nullable|string',
            'sponsors.*.name' => 'nullable|string',
            'sponsors.*.logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with([
                'error' => 'Failed to create event. Please check the input fields.'
            ]);
        }

        $data = $request->all();
        $slug = Str::slug($request->title);
        // Ensure unique slug
        $count = Event::where('slug', $slug)->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }
        $data['slug'] = $slug;

        $eventFolder = public_path('events/' . $slug);
        if (!File::exists($eventFolder)) {
            File::makeDirectory($eventFolder, 0755, true);
        }

        // Handle banners
        $banners = [];
        if ($request->hasFile('banners')) {
            foreach ($request->file('banners') as $banner) {
                $filename = time() . '_' . $banner->getClientOriginalName();
                $banner->move($eventFolder, $filename);
                $banners[] = 'events/' . $slug . '/' . $filename;
            }
        }
        $data['banners'] = $banners;

        // Handle documents
        $documents = [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $document) {
                $filename = time() . '_' . $document->getClientOriginalName();
                $document->move($eventFolder, $filename);
                $documents[] = 'events/' . $slug . '/' . $filename;
            }
        }
        $data['documents'] = $documents;

        // Handle tags
        $data['tags'] = $request->tags ?? [];

        // Handle speakers
        $speakers = [];
        if ($request->has('speakers')) {
            foreach ($request->speakers as $speaker) {
                if (!empty($speaker['name']) || !empty($speaker['designation']) || !empty($speaker['bio'])) {
                    $speakers[] = [
                        'name' => $speaker['name'] ?? '',
                        'designation' => $speaker['designation'] ?? '',
                        'bio' => $speaker['bio'] ?? ''
                    ];
                }
            }
        }
        $data['speakers'] = $speakers;

        // Handle sponsors
        $sponsors = [];
        if ($request->has('sponsors')) {
            foreach ($request->sponsors as $index => $sponsor) {
                if (!empty($sponsor['name'])) {
                    $sponsorData = ['name' => $sponsor['name']];
                    
                    // Handle sponsor logo
                    if (isset($request->file('sponsors')[$index]['logo']) && $request->file('sponsors')[$index]['logo']) {
                        $logo = $request->file('sponsors')[$index]['logo'];
                        $filename = time() . '_sponsor_' . $index . '_' . $logo->getClientOriginalName();
                        $logo->move($eventFolder, $filename);
                        $sponsorData['logo'] = 'events/' . $slug . '/' . $filename;
                    }
                    
                    $sponsors[] = $sponsorData;
                }
            }
        }
        $data['sponsors'] = $sponsors;

        Event::create($data);

        return redirect()->route('events.index')->with([
            'success' => 'Event created successfully!'
        ]);
    }

    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $categories = \App\Models\Category::where('is_active', true)->get();
        return view('admin.events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, Event $event)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags.*' => 'nullable|string',
            'new_banners.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_date' => 'nullable|date',
            'event_time' => 'nullable|string',
            'venue' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'about_event' => 'nullable|string',
            'agenda' => 'nullable|string',
            'organizer_name' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'status' => 'nullable|in:draft,archived,published',
            'is_featured' => 'nullable|boolean',
            'visibility' => 'nullable|boolean',
            'max_attendees' => 'nullable|integer|min:0',
            'registration_required' => 'nullable|boolean',
            'registration_deadline' => 'nullable|date',
            'new_documents.*' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'speakers.*.name' => 'nullable|string',
            'speakers.*.designation' => 'nullable|string',
            'speakers.*.bio' => 'nullable|string',
            'sponsors.*.name' => 'nullable|string',
            'sponsors.*.logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with([
                'error' => 'Failed to update event. Please check the input fields.'
            ]);
        }

        $data = $request->all();
        $newSlug = Str::slug($request->title);
        $oldSlug = $event->slug;
        if ($newSlug !== $oldSlug) {
            $count = Event::where('slug', $newSlug)->where('id', '!=', $event->id)->count();
            if ($count > 0) {
                $newSlug .= '-' . ($count + 1);
            }
            $data['slug'] = $newSlug;

            // Move event folder
            $oldFolder = public_path('events/' . $oldSlug);
            $newFolder = public_path('events/' . $newSlug);
            if (File::exists($oldFolder)) {
                File::move($oldFolder, $newFolder);
            }
        } else {
            $newSlug = $oldSlug;
        }

        $eventFolder = public_path('events/' . $newSlug);

        // Handle banners
        $banners = $event->banners ?? [];
        // Delete selected banners
        if ($request->has('delete_banners')) {
            foreach ($request->delete_banners as $path) {
                $fullPath = public_path($path);
                if (File::exists($fullPath)) {
                    File::delete($fullPath);
                }
                if (($key = array_search($path, $banners)) !== false) {
                    unset($banners[$key]);
                }
            }
        }
        // Add new banners
        if ($request->hasFile('new_banners')) {
            foreach ($request->file('new_banners') as $banner) {
                $filename = time() . '_' . $banner->getClientOriginalName();
                $banner->move($eventFolder, $filename);
                $banners[] = 'events/' . $newSlug . '/' . $filename;
            }
        }
        // Update paths if slug changed
        if ($newSlug !== $oldSlug) {
            foreach ($banners as &$path) {
                $path = str_replace('events/' . $oldSlug, 'events/' . $newSlug, $path);
            }
        }
        $data['banners'] = array_values($banners);

        // Handle documents
        $documents = $event->documents ?? [];
        // Delete selected documents
        if ($request->has('delete_documents')) {
            foreach ($request->delete_documents as $path) {
                $fullPath = public_path($path);
                if (File::exists($fullPath)) {
                    File::delete($fullPath);
                }
                if (($key = array_search($path, $documents)) !== false) {
                    unset($documents[$key]);
                }
            }
        }
        // Add new documents
        if ($request->hasFile('new_documents')) {
            foreach ($request->file('new_documents') as $document) {
                $filename = time() . '_' . $document->getClientOriginalName();
                $document->move($eventFolder, $filename);
                $documents[] = 'events/' . $newSlug . '/' . $filename;
            }
        }
        // Update paths if slug changed
        if ($newSlug !== $oldSlug) {
            foreach ($documents as &$path) {
                $path = str_replace('events/' . $oldSlug, 'events/' . $newSlug, $path);
            }
        }
        $data['documents'] = array_values($documents);

        // Handle tags
        $data['tags'] = $request->tags ?? [];

        // Handle speakers
        $speakers = [];
        if ($request->has('speakers')) {
            foreach ($request->speakers as $speaker) {
                if (!empty($speaker['name']) || !empty($speaker['designation']) || !empty($speaker['bio'])) {
                    $speakers[] = [
                        'name' => $speaker['name'] ?? '',
                        'designation' => $speaker['designation'] ?? '',
                        'bio' => $speaker['bio'] ?? ''
                    ];
                }
            }
        }
        $data['speakers'] = $speakers;

        // Handle sponsors
        $sponsors = [];
        if ($request->has('sponsors')) {
            foreach ($request->sponsors as $index => $sponsor) {
                if (!empty($sponsor['name'])) {
                    $sponsorData = ['name' => $sponsor['name']];
                    
                    // Handle sponsor logo
                    if (isset($request->file('sponsors')[$index]['logo']) && $request->file('sponsors')[$index]['logo']) {
                        $logo = $request->file('sponsors')[$index]['logo'];
                        $filename = time() . '_sponsor_' . $index . '_' . $logo->getClientOriginalName();
                        $logo->move($eventFolder, $filename);
                        $sponsorData['logo'] = 'events/' . $newSlug . '/' . $filename;
                    } elseif (isset($event->sponsors[$index]['logo'])) {
                        // Keep existing logo if no new one uploaded
                        $sponsorData['logo'] = $event->sponsors[$index]['logo'];
                        if ($newSlug !== $oldSlug) {
                            $sponsorData['logo'] = str_replace('events/' . $oldSlug, 'events/' . $newSlug, $sponsorData['logo']);
                        }
                    }
                    
                    $sponsors[] = $sponsorData;
                }
            }
        }
        $data['sponsors'] = $sponsors;

        $event->update($data);

        return redirect()->route('events.index')->with([
            'success' => 'Event updated successfully!'
        ]);
    }

    public function destroy(Event $event)
    {
        try {
            // Delete event folder
            $eventFolder = public_path('events/' . $event->slug);
            if (File::exists($eventFolder)) {
                File::deleteDirectory($eventFolder);
            }
            $event->delete();
            return response()->json(['success' => 'Event deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete the event.'], 500);
        }
    }
}
