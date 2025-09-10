<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventRegistration;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class EventRegistrationController extends Controller
{
    public function index(Request $request)
    {
        $query = EventRegistration::with(['user', 'event']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by event
        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        // Filter by user name
        if ($request->filled('user_name')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user_name . '%');
            });
        }

        // Filter by event title
        if ($request->filled('event_title')) {
            $query->whereHas('event', function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->event_title . '%');
            });
        }

        // Filter by registration date
        if ($request->filled('date_from')) {
            $query->whereDate('registered_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('registered_at', '<=', $request->date_to);
        }

        $registrations = $query->orderBy('registered_at', 'desc')->paginate(10);
        $events = Event::where('status', 1)->orderBy('title')->get();
        
        // Get unique event titles from existing registrations for dynamic filter
        $eventTitles = EventRegistration::with('event')
            ->whereHas('event')
            ->get()
            ->pluck('event.title')
            ->unique()
            ->sort()
            ->values();

        return view('admin.event-registrations.index', compact('registrations', 'events', 'eventTitles'));
    }

    public function show(EventRegistration $eventRegistration)
    {
        $eventRegistration->load(['user', 'event']);
        return view('admin.event-registrations.show', compact('eventRegistration'));
    }

    public function approve(Request $request, EventRegistration $eventRegistration)
    {
        $validator = Validator::make($request->all(), [
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $eventRegistration->update([
                'status' => 'approved',
                'admin_notes' => $request->admin_notes,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Event registration approved successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to approve registration. Please try again.'
            ], 500);
        }
    }

    public function reject(Request $request, EventRegistration $eventRegistration)
    {
        $validator = Validator::make($request->all(), [
            'admin_notes' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $eventRegistration->update([
                'status' => 'rejected',
                'admin_notes' => $request->admin_notes,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Event registration rejected successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to reject registration. Please try again.'
            ], 500);
        }
    }

    public function cancel(EventRegistration $eventRegistration)
    {
        try {
            $eventRegistration->update([
                'status' => 'cancelled',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Event registration cancelled successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to cancel registration. Please try again.'
            ], 500);
        }
    }
}
