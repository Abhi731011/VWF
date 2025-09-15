<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportFeedback;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupportFeedbackController extends Controller
{
    /**
     * Display a listing of support feedback tickets
     */
    public function index(Request $request)
    {
        $query = SupportFeedback::with('user');

        // Apply filters if provided
        if ($request->filled('subject')) {
            $query->where('subject', 'like', '%' . $request->subject . '%');
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('user_email')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('email', 'like', '%' . $request->user_email . '%');
            });
        }

        $supportFeedbacks = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.support-feedback.index', compact('supportFeedbacks'));
    }

    /**
     * Display the specified support feedback ticket
     */
    public function show(SupportFeedback $supportFeedback)
    {
        $supportFeedback->load('user');
        return view('admin.support-feedback.show', compact('supportFeedback'));
    }

    /**
     * Update the admin response for a support feedback ticket
     */
    public function updateResponse(Request $request, SupportFeedback $supportFeedback)
    {
        $validator = Validator::make($request->all(), [
            'admin_response' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $supportFeedback->update([
            'admin_response' => $request->admin_response,
            'status' => 'in_progress'
        ]);

        return redirect()->route('admin.support-feedback.show', $supportFeedback)
            ->with('success', 'Response updated successfully.');
    }

    /**
     * Close a support feedback ticket
     */
    public function close(Request $request, SupportFeedback $supportFeedback)
    {
        $validator = Validator::make($request->all(), [
            'admin_response' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $supportFeedback->update([
            'admin_response' => $request->admin_response,
            'status' => 'closed',
            'resolved_at' => now()
        ]);

        return redirect()->route('admin.support-feedback.index')
            ->with('success', 'Ticket closed successfully.');
    }

    /**
     * Change the status of a support feedback ticket
     */
    public function updateStatus(Request $request, SupportFeedback $supportFeedback)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:open,in_progress,resolved,closed',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid status'], 400);
        }

        $updateData = ['status' => $request->status];
        
        if ($request->status === 'closed' || $request->status === 'resolved') {
            $updateData['resolved_at'] = now();
        }

        $supportFeedback->update($updateData);

        return response()->json(['success' => 'Status updated successfully']);
    }

    /**
     * Remove the specified support feedback ticket from storage
     */
    public function destroy(Request $request, SupportFeedback $supportFeedback)
    {
        try {
            // Log the deletion attempt
            \Log::info('Attempting to delete support feedback', ['id' => $supportFeedback->id]);
            
            $supportFeedback->delete();
            
            \Log::info('Support feedback deleted successfully', ['id' => $supportFeedback->id]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => 'Support feedback ticket deleted successfully.']);
            }

            return redirect()->route('admin.support-feedback.index')
                ->with('success', 'Support feedback ticket deleted successfully.');
        } catch (\Exception $e) {
            \Log::error('Failed to delete support feedback', [
                'id' => $supportFeedback->id ?? 'unknown',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['error' => 'Failed to delete the support feedback ticket: ' . $e->getMessage()], 500);
            }

            return redirect()->route('admin.support-feedback.index')
                ->with('error', 'Failed to delete the support feedback ticket.');
        }
    }

    /**
     * Get statistics for dashboard
     */
    public function getStats()
    {
        $stats = [
            'total' => SupportFeedback::count(),
            'open' => SupportFeedback::where('status', 'open')->count(),
            'in_progress' => SupportFeedback::where('status', 'in_progress')->count(),
            'resolved' => SupportFeedback::where('status', 'resolved')->count(),
            'closed' => SupportFeedback::where('status', 'closed')->count(),
            'urgent' => SupportFeedback::where('priority', 'urgent')->whereIn('status', ['open', 'in_progress'])->count(),
        ];

        return response()->json($stats);
    }
}
