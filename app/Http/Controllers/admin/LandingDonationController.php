<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingDonation;
use Illuminate\Http\Request;

class LandingDonationController extends Controller
{
    /**
     * Display a listing of landing donations.
     */
    public function index(Request $request)
    {
        $query = LandingDonation::with(['project']);

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('donor_name')) {
            $query->where('donor_name', 'like', '%' . $request->donor_name . '%');
        }

        if ($request->filled('donor_email')) {
            $query->where('donor_email', 'like', '%' . $request->donor_email . '%');
        }

        if ($request->filled('referral_volunteer_id')) {
            $query->where('referral_volunteer_id', 'like', '%' . $request->referral_volunteer_id . '%');
        }

        if ($request->filled('is_anonymous')) {
            $query->where('is_anonymous', $request->is_anonymous);
        }

        if ($request->filled('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        if ($request->filled('amount_min')) {
            $query->where('amount', '>=', $request->amount_min);
        }

        if ($request->filled('amount_max')) {
            $query->where('amount', '<=', $request->amount_max);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $donations = $query->orderBy('created_at', 'desc')->paginate(15);

        // Get statistics
        $stats = [
            'total_donations' => LandingDonation::count(),
            'total_amount' => LandingDonation::sum('amount'),
            'completed_donations' => LandingDonation::where('status', 'completed')->count(),
            'pending_donations' => LandingDonation::where('status', 'pending')->count(),
            'anonymous_donations' => LandingDonation::where('is_anonymous', true)->count(),
            'referral_donations' => LandingDonation::whereNotNull('referral_volunteer_id')->count(),
        ];

        return view('admin.donations.landing-index', compact('donations', 'stats'));
    }

    /**
     * Display the specified landing donation.
     */
    public function show(LandingDonation $landingDonation)
    {
        $landingDonation->load(['project']);
        
        return view('admin.donations.landing-show', compact('landingDonation'));
    }

    /**
     * Remove the specified landing donation from storage.
     */
    public function destroy(Request $request, LandingDonation $landingDonation)
    {
        $landingDonation->delete();

        if ($request->ajax()) {
            return response()->json(['success' => 'Landing donation deleted successfully.']);
        }

        return redirect()->route('admin.landing-donations.index')->with('success', 'Landing donation deleted successfully.');
    }

    /**
     * Export landing donations to CSV.
     */
    public function export(Request $request)
    {
        $query = LandingDonation::with(['project']);

        // Apply same filters as index
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('donor_name')) {
            $query->where('donor_name', 'like', '%' . $request->donor_name . '%');
        }

        if ($request->filled('referral_volunteer_id')) {
            $query->where('referral_volunteer_id', 'like', '%' . $request->referral_volunteer_id . '%');
        }

        $donations = $query->orderBy('created_at', 'desc')->get();

        $filename = 'landing_donations_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($donations) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, [
                'ID',
                'Donor Name',
                'Donor Email',
                'Donor Phone',
                'Amount',
                'Currency',
                'Project',
                'Referral Volunteer ID',
                'Is Anonymous',
                'Status',
                'Message',
                'Payment ID',
                'Created At'
            ]);

            // CSV data
            foreach ($donations as $donation) {
                fputcsv($file, [
                    $donation->id,
                    $donation->donor_name ?? 'Anonymous',
                    $donation->donor_email ?? 'N/A',
                    $donation->donor_phone ?? 'N/A',
                    $donation->amount,
                    $donation->currency,
                    $donation->project ? $donation->project->title : 'General Donation',
                    $donation->referral_volunteer_id ?? 'N/A',
                    $donation->is_anonymous ? 'Yes' : 'No',
                    ucfirst($donation->status),
                    $donation->message ?? 'N/A',
                    $donation->razorpay_payment_id ?? 'N/A',
                    $donation->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}