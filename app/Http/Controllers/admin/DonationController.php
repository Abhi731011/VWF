<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\PackagePurchase;
use App\Models\User;
use App\Models\Project;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    /**
     * Display the main donation module index
     */
    public function index()
    {
        $stats = [
            'total_donations' => Donation::count(),
            'total_donation_amount' => Donation::sum('amount'),
            'total_package_purchases' => PackagePurchase::count(),
            'total_package_amount' => PackagePurchase::sum('amount'),
            'recent_donations' => Donation::with(['user', 'project'])->latest()->limit(5)->get(),
            'recent_purchases' => PackagePurchase::with(['user', 'package'])->latest()->limit(5)->get(),
        ];

        return view('admin.donations.index', compact('stats'));
    }

    /**
     * Display user packages (package purchases)
     */
    public function userPackages(Request $request)
    {
        $query = PackagePurchase::with(['user', 'package']);

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('package_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        if ($request->filled('package_id')) {
            $query->where('package_id', $request->get('package_id'));
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->get('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->get('date_to'));
        }

        if ($request->filled('amount_min')) {
            $query->where('amount', '>=', $request->get('amount_min'));
        }

        if ($request->filled('amount_max')) {
            $query->where('amount', '<=', $request->get('amount_max'));
        }

        $packages = $query->latest()->paginate(15);
        
        // Get filter options
        $packagesList = Package::where('status', true)->get();
        $statuses = ['pending', 'completed', 'failed', 'cancelled'];

        return view('admin.donations.user-packages', compact('packages', 'packagesList', 'statuses'));
    }

    /**
     * Display project donations
     */
    public function projectDonations(Request $request)
    {
        $query = Donation::with(['user', 'project']);

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('project_name', 'like', "%{$search}%")
                  ->orWhere('donor_name', 'like', "%{$search}%")
                  ->orWhere('donor_email', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  })
                  ->orWhereHas('project', function ($projectQuery) use ($search) {
                      $projectQuery->where('title', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        if ($request->filled('project_id')) {
            $query->where('project_id', $request->get('project_id'));
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->get('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->get('date_to'));
        }

        if ($request->filled('amount_min')) {
            $query->where('amount', '>=', $request->get('amount_min'));
        }

        if ($request->filled('amount_max')) {
            $query->where('amount', '<=', $request->get('amount_max'));
        }

        if ($request->filled('is_anonymous')) {
            $query->where('is_anonymous', $request->get('is_anonymous') == '1');
        }

        $donations = $query->latest()->paginate(15);
        
        // Get filter options
        $projects = Project::where('status', 'published')->get();
        $statuses = ['pending', 'completed', 'failed', 'cancelled'];

        return view('admin.donations.project-donations', compact('donations', 'projects', 'statuses'));
    }

    /**
     * Show individual package purchase details
     */
    public function showPackagePurchase(PackagePurchase $packagePurchase)
    {
        $packagePurchase->load(['user', 'package']);
        return view('admin.donations.show-package-purchase', compact('packagePurchase'));
    }

    /**
     * Show individual donation details
     */
    public function showDonation(Donation $donation)
    {
        $donation->load(['user', 'project']);
        return view('admin.donations.show-donation', compact('donation'));
    }

    /**
     * Get donation statistics for dashboard
     */
    public function getStats(Request $request)
    {
        $startDate = Carbon::parse($request->get('start_date', Carbon::now()->subDays(30)));
        $endDate = Carbon::parse($request->get('end_date', Carbon::now()));

        $stats = [
            'total_donations' => Donation::count(),
            'total_donation_amount' => Donation::sum('amount'),
            'donations_this_period' => Donation::whereBetween('created_at', [$startDate, $endDate])->count(),
            'donation_amount_this_period' => Donation::whereBetween('created_at', [$startDate, $endDate])->sum('amount'),
            'total_package_purchases' => PackagePurchase::count(),
            'total_package_amount' => PackagePurchase::sum('amount'),
            'purchases_this_period' => PackagePurchase::whereBetween('created_at', [$startDate, $endDate])->count(),
            'package_amount_this_period' => PackagePurchase::whereBetween('created_at', [$startDate, $endDate])->sum('amount'),
            'recent_donations' => Donation::with(['user', 'project'])->latest()->limit(5)->get(),
            'recent_purchases' => PackagePurchase::with(['user', 'package'])->latest()->limit(5)->get(),
        ];

        return response()->json($stats);
    }
}
