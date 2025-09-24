<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Event;
use App\Models\Contact;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Package;
use App\Models\EventRegistration;
use App\Models\CertificateRequest;
use App\Models\SupportFeedback;
use App\Models\Category;
use App\Models\Donation;
use App\Models\LandingDonation;
use App\Models\PackagePurchase;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get date range filters
        $startDate = $request->get('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));
        
        // Convert to Carbon instances
        $startDateCarbon = Carbon::parse($startDate);
        $endDateCarbon = Carbon::parse($endDate);

        // Get dashboard statistics
        $stats = $this->getDashboardStats($startDateCarbon, $endDateCarbon);
        
        // Get recent activities
        $recentActivities = $this->getRecentActivities();
        
        // Get chart data
        $chartData = $this->getChartData($startDateCarbon, $endDateCarbon);
        
        // Get top performing data
        $topData = $this->getTopPerformingData();

        return view('admin.dashboard', compact(
            'stats', 
            'recentActivities', 
            'chartData', 
            'topData',
            'startDate',
            'endDate'
        ));
    }

    private function getDashboardStats($startDate, $endDate)
    {
        return [
            // Total counts
            'total_projects' => Project::count(),
            'total_events' => Event::count(),
            'total_users' => User::count(),
            'total_contacts' => Contact::count(),
            'total_galleries' => Gallery::count(),
            'total_packages' => Package::count(),
            'total_registrations' => EventRegistration::count(),
            'total_certificates' => CertificateRequest::count(),
            'total_feedback' => SupportFeedback::count(),
            'total_donations' => Donation::count(),
            'total_donation_amount' => Donation::sum('amount'),
            'total_landing_donations' => LandingDonation::count(),
            'total_landing_donation_amount' => LandingDonation::sum('amount'),
            'total_package_purchases' => PackagePurchase::count(),
            'total_package_amount' => PackagePurchase::sum('amount'),

            // Period-specific counts
            'projects_this_period' => Project::whereBetween('created_at', [$startDate, $endDate])->count(),
            'events_this_period' => Event::whereBetween('created_at', [$startDate, $endDate])->count(),
            'users_this_period' => User::whereBetween('created_at', [$startDate, $endDate])->count(),
            'contacts_this_period' => Contact::whereBetween('created_at', [$startDate, $endDate])->count(),
            'registrations_this_period' => EventRegistration::whereBetween('created_at', [$startDate, $endDate])->count(),
            'certificates_this_period' => CertificateRequest::whereBetween('created_at', [$startDate, $endDate])->count(),
            'feedback_this_period' => SupportFeedback::whereBetween('created_at', [$startDate, $endDate])->count(),
            'donations_this_period' => Donation::whereBetween('created_at', [$startDate, $endDate])->count(),
            'donation_amount_this_period' => Donation::whereBetween('created_at', [$startDate, $endDate])->sum('amount'),
            'landing_donations_this_period' => LandingDonation::whereBetween('created_at', [$startDate, $endDate])->count(),
            'landing_donation_amount_this_period' => LandingDonation::whereBetween('created_at', [$startDate, $endDate])->sum('amount'),
            'purchases_this_period' => PackagePurchase::whereBetween('created_at', [$startDate, $endDate])->count(),
            'package_amount_this_period' => PackagePurchase::whereBetween('created_at', [$startDate, $endDate])->sum('amount'),

            // Status counts
            'published_projects' => Project::where('status', 'published')->count(),
            'draft_projects' => Project::where('status', 'draft')->count(),
            'published_events' => Event::where('status', 'published')->count(),
            'draft_events' => Event::where('status', 'draft')->count(),
            'active_users' => User::where('created_at', '>=', Carbon::now()->subDays(30))->count(),
            'pending_registrations' => EventRegistration::where('status', 'pending')->count(),
            'approved_certificates' => CertificateRequest::where('status', 'approved')->count(),
            'pending_certificates' => CertificateRequest::where('status', 'pending')->count(),
            'open_feedback' => SupportFeedback::where('status', 'open')->count(),
            'completed_donations' => Donation::where('status', 'completed')->count(),
            'pending_donations' => Donation::where('status', 'pending')->count(),
            'completed_landing_donations' => LandingDonation::where('status', 'completed')->count(),
            'pending_landing_donations' => LandingDonation::where('status', 'pending')->count(),
            'completed_purchases' => PackagePurchase::where('status', 'completed')->count(),
            'pending_purchases' => PackagePurchase::where('status', 'pending')->count(),

            // Growth percentages
            'projects_growth' => $this->calculateGrowthPercentage('projects', $startDate, $endDate),
            'events_growth' => $this->calculateGrowthPercentage('events', $startDate, $endDate),
            'users_growth' => $this->calculateGrowthPercentage('users', $startDate, $endDate),
            'contacts_growth' => $this->calculateGrowthPercentage('contacts', $startDate, $endDate),
            'donations_growth' => $this->calculateGrowthPercentage('donations', $startDate, $endDate),
            'purchases_growth' => $this->calculateGrowthPercentage('purchases', $startDate, $endDate),
        ];
    }

    private function calculateGrowthPercentage($model, $startDate, $endDate)
    {
        $previousPeriodStart = $startDate->copy()->subDays($startDate->diffInDays($endDate));
        $previousPeriodEnd = $startDate->copy()->subDay();
        
        $currentCount = $this->getModelCount($model, $startDate, $endDate);
        $previousCount = $this->getModelCount($model, $previousPeriodStart, $previousPeriodEnd);
        
        if ($previousCount == 0) {
            return $currentCount > 0 ? 100 : 0;
        }
        
        return round((($currentCount - $previousCount) / $previousCount) * 100, 1);
    }

    private function getModelCount($model, $startDate, $endDate)
    {
        switch ($model) {
            case 'projects':
                return Project::whereBetween('created_at', [$startDate, $endDate])->count();
            case 'events':
                return Event::whereBetween('created_at', [$startDate, $endDate])->count();
            case 'users':
                return User::whereBetween('created_at', [$startDate, $endDate])->count();
            case 'contacts':
                return Contact::whereBetween('created_at', [$startDate, $endDate])->count();
            case 'donations':
                return Donation::whereBetween('created_at', [$startDate, $endDate])->count();
            case 'purchases':
                return PackagePurchase::whereBetween('created_at', [$startDate, $endDate])->count();
            default:
                return 0;
        }
    }

    private function getRecentActivities()
    {
        $activities = collect();

        // Recent projects
        $recentProjects = Project::with('category')
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($project) {
                return [
                    'type' => 'project',
                    'title' => $project->title,
                    'status' => $project->status,
                    'created_at' => $project->created_at,
                    'url' => route('projects.show', $project),
                    'icon' => 'fas fa-project-diagram',
                    'color' => 'primary'
                ];
            });

        // Recent events
        $recentEvents = Event::with('category')
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($event) {
                return [
                    'type' => 'event',
                    'title' => $event->title,
                    'status' => $event->status,
                    'created_at' => $event->created_at,
                    'url' => route('events.show', $event),
                    'icon' => 'fas fa-calendar-alt',
                    'color' => 'success'
                ];
            });

        // Recent contacts
        $recentContacts = Contact::latest()
            ->limit(5)
            ->get()
            ->map(function ($contact) {
                return [
                    'type' => 'contact',
                    'title' => $contact->first_name . ' - ' . $contact->subject,
                    'status' => 'new',
                    'created_at' => $contact->created_at,
                    'url' => route('admin.contact.show', $contact),
                    'icon' => 'fas fa-envelope',
                    'color' => 'info'
                ];
            });

        // Recent registrations
        $recentRegistrations = EventRegistration::with('event')
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($registration) {
                return [
                    'type' => 'registration',
                    'title' => $registration->event->title ?? 'Event Registration',
                    'status' => $registration->status,
                    'created_at' => $registration->created_at,
                    'url' => route('admin.event-registrations.show', $registration),
                    'icon' => 'fas fa-user-plus',
                    'color' => 'warning'
                ];
            });

        // Recent donations
        $recentDonations = Donation::with(['user', 'project'])
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($donation) {
                return [
                    'type' => 'donation',
                    'title' => ($donation->donor_name ?? $donation->user->name ?? 'Anonymous') . ' - ₹' . number_format($donation->amount, 2),
                    'status' => $donation->status,
                    'created_at' => $donation->created_at,
                    'url' => route('admin.donations.show-donation', $donation),
                    'icon' => 'fas fa-heart',
                    'color' => 'danger'
                ];
            });

        // Recent package purchases
        $recentPurchases = PackagePurchase::with(['user', 'package'])
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($purchase) {
                return [
                    'type' => 'purchase',
                    'title' => ($purchase->user->name ?? $purchase->email) . ' - ₹' . number_format($purchase->amount, 2),
                    'status' => $purchase->status,
                    'created_at' => $purchase->created_at,
                    'url' => route('admin.donations.show-package-purchase', $purchase),
                    'icon' => 'fas fa-shopping-cart',
                    'color' => 'primary'
                ];
            });

        return $activities
            ->merge($recentProjects)
            ->merge($recentEvents)
            ->merge($recentContacts)
            ->merge($recentRegistrations)
            ->merge($recentDonations)
            ->merge($recentPurchases)
            ->sortByDesc('created_at')
            ->take(10)
            ->values();
    }

    private function getChartData($startDate, $endDate)
    {
        // Monthly data for the selected period
        $months = [];
        $current = $startDate->copy()->startOfMonth();
        
        while ($current->lte($endDate)) {
            $months[] = $current->format('M Y');
            $current->addMonth();
        }

        // Projects data
        $projectsData = [];
        $eventsData = [];
        $usersData = [];
        $contactsData = [];

        foreach ($months as $month) {
            $monthStart = Carbon::parse($month)->startOfMonth();
            $monthEnd = Carbon::parse($month)->endOfMonth();
            
            $projectsData[] = Project::whereBetween('created_at', [$monthStart, $monthEnd])->count();
            $eventsData[] = Event::whereBetween('created_at', [$monthStart, $monthEnd])->count();
            $usersData[] = User::whereBetween('created_at', [$monthStart, $monthEnd])->count();
            $contactsData[] = Contact::whereBetween('created_at', [$monthStart, $monthEnd])->count();
        }

        return [
            'months' => $months,
            'projects' => $projectsData,
            'events' => $eventsData,
            'users' => $usersData,
            'contacts' => $contactsData,
        ];
    }

    private function getTopPerformingData()
    {
        return [
            'top_categories' => Category::withCount('projects')
                ->orderBy('projects_count', 'desc')
                ->limit(5)
                ->get(),
            'top_projects' => Project::with('category')
                ->where('status', 'published')
                ->latest()
                ->limit(5)
                ->get(),
            'upcoming_events' => Event::where('event_date', '>=', Carbon::now())
                ->where('status', 'published')
                ->orderBy('event_date', 'asc')
                ->limit(5)
                ->get(),
            'recent_feedback' => SupportFeedback::latest()
                ->limit(5)
                ->get(),
            'recent_donations' => Donation::with(['user', 'project'])
                ->latest()
                ->limit(5)
                ->get(),
            'recent_purchases' => PackagePurchase::with(['user', 'package'])
                ->latest()
                ->limit(5)
                ->get(),
        ];
    }

    public function getStats(Request $request)
    {
        $startDate = Carbon::parse($request->get('start_date', Carbon::now()->subDays(30)));
        $endDate = Carbon::parse($request->get('end_date', Carbon::now()));
        
        $stats = $this->getDashboardStats($startDate, $endDate);
        
        return response()->json($stats);
    }
}
