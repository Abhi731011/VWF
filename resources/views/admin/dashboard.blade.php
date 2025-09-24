@extends('admin.master.master')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            </div>
        </div>

        <!-- Date Range Filter -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Filter Data</h4>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.dashboard') }}" class="form-inline">
                            <div class="form-group mr-3">
                                <label for="start_date" class="mr-2">From:</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $startDate }}">
                            </div>
                            <div class="form-group mr-3">
                                <label for="end_date" class="mr-2">To:</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $endDate }}">
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                                <i class="fas fa-refresh"></i> Reset
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row">
            <!-- Projects Card -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Total Projects</h5>
                                        <h2 class="mb-3 font-18">{{ $stats['total_projects'] }}</h2>
                                        <p class="mb-0">
                                            <span class="col-green">{{ $stats['projects_growth'] }}%</span> 
                                            Growth ({{ $stats['projects_this_period'] }} this period)
                                        </p>
                                        <div class="mt-2">
                                            <small class="text-muted">
                                                Published: {{ $stats['published_projects'] }} | 
                                                Draft: {{ $stats['draft_projects'] }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <i class="fas fa-project-diagram fa-3x text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Events Card -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Total Events</h5>
                                        <h2 class="mb-3 font-18">{{ $stats['total_events'] }}</h2>
                                        <p class="mb-0">
                                            <span class="col-green">{{ $stats['events_growth'] }}%</span> 
                                            Growth ({{ $stats['events_this_period'] }} this period)
                                        </p>
                                        <div class="mt-2">
                                            <small class="text-muted">
                                                Published: {{ $stats['published_events'] }} | 
                                                Draft: {{ $stats['draft_events'] }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <i class="fas fa-calendar-alt fa-3x text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Card -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Total Users</h5>
                                        <h2 class="mb-3 font-18">{{ $stats['total_users'] }}</h2>
                                        <p class="mb-0">
                                            <span class="col-green">{{ $stats['users_growth'] }}%</span> 
                                            Growth ({{ $stats['users_this_period'] }} this period)
                                        </p>
                                        <div class="mt-2">
                                            <small class="text-muted">
                                                Active (30 days): {{ $stats['active_users'] }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <i class="fas fa-users fa-3x text-info"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contacts Card -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Total Contacts</h5>
                                        <h2 class="mb-3 font-18">{{ $stats['total_contacts'] }}</h2>
                                        <p class="mb-0">
                                            <span class="col-green">{{ $stats['contacts_growth'] }}%</span> 
                                            Growth ({{ $stats['contacts_this_period'] }} this period)
                                        </p>
                                        <div class="mt-2">
                                            <small class="text-muted">
                                                New messages this period
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <i class="fas fa-envelope fa-3x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Statistics Row -->
        <div class="row">
            <!-- Event Registrations -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Event Registrations</h5>
                                        <h2 class="mb-3 font-18">{{ $stats['total_registrations'] }}</h2>
                                        <p class="mb-0">
                                            {{ $stats['registrations_this_period'] }} this period
                                        </p>
                                        <div class="mt-2">
                                            <small class="text-muted">
                                                Pending: {{ $stats['pending_registrations'] }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <i class="fas fa-user-plus fa-3x text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Certificates -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Certificates</h5>
                                        <h2 class="mb-3 font-18">{{ $stats['total_certificates'] }}</h2>
                                        <p class="mb-0">
                                            {{ $stats['certificates_this_period'] }} this period
                                        </p>
                                        <div class="mt-2">
                                            <small class="text-muted">
                                                Approved: {{ $stats['approved_certificates'] }} | 
                                                Pending: {{ $stats['pending_certificates'] }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <i class="fas fa-certificate fa-3x text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Support Feedback -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Support & Feedback</h5>
                                        <h2 class="mb-3 font-18">{{ $stats['total_feedback'] }}</h2>
                                        <p class="mb-0">
                                            {{ $stats['feedback_this_period'] }} this period
                                        </p>
                                        <div class="mt-2">
                                            <small class="text-muted">
                                                Open: {{ $stats['open_feedback'] }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <i class="fas fa-headset fa-3x text-info"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Galleries -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Galleries</h5>
                                        <h2 class="mb-3 font-18">{{ $stats['total_galleries'] }}</h2>
                                        <p class="mb-0">
                                            Total galleries
                                        </p>
                                        <div class="mt-2">
                                            <small class="text-muted">
                                                Image collections
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <i class="fas fa-images fa-3x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Donation and Package Statistics Row -->
        <div class="row">
            <!-- Total Donations -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Total Donations</h5>
                                        <h2 class="mb-3 font-18">{{ $stats['total_donations'] }}</h2>
                                        <p class="mb-0">
                                            <span class="col-green">₹{{ number_format($stats['total_donation_amount'], 2) }}</span> 
                                            Total Amount
                                        </p>
                                        <div class="mt-2">
                                            <small class="text-muted">
                                                This period: {{ $stats['donations_this_period'] }} (₹{{ number_format($stats['donation_amount_this_period'], 2) }})
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <i class="fas fa-heart fa-3x text-danger"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Package Purchases -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Package Purchases</h5>
                                        <h2 class="mb-3 font-18">{{ $stats['total_package_purchases'] }}</h2>
                                        <p class="mb-0">
                                            <span class="col-green">₹{{ number_format($stats['total_package_amount'], 2) }}</span> 
                                            Total Amount
                                        </p>
                                        <div class="mt-2">
                                            <small class="text-muted">
                                                This period: {{ $stats['purchases_this_period'] }} (₹{{ number_format($stats['package_amount_this_period'], 2) }})
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <i class="fas fa-shopping-cart fa-3x text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Completed Donations -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Completed Donations</h5>
                                        <h2 class="mb-3 font-18">{{ $stats['completed_donations'] }}</h2>
                                        <p class="mb-0">
                                            <span class="col-green">{{ $stats['donations_growth'] }}%</span> 
                                            Growth
                                        </p>
                                        <div class="mt-2">
                                            <small class="text-muted">
                                                Pending: {{ $stats['pending_donations'] }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <i class="fas fa-check-circle fa-3x text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Completed Purchases -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Completed Purchases</h5>
                                        <h2 class="mb-3 font-18">{{ $stats['completed_purchases'] }}</h2>
                                        <p class="mb-0">
                                            <span class="col-green">{{ $stats['purchases_growth'] }}%</span> 
                                            Growth
                                        </p>
                                        <div class="mt-2">
                                            <small class="text-muted">
                                                Pending: {{ $stats['pending_purchases'] }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <i class="fas fa-receipt fa-3x text-info"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Analytics -->
        <

        <!-- Top Performing Data -->
        <div class="row">
            <!-- Top Categories -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Top Categories by Projects (Causes)</h4>
                    </div>
                    <div class="card-body">
                        @forelse($topData['top_categories'] as $category)
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="mb-0">{{ $category->name }}</h6>
                                    <small class="text-muted">{{ $category->projects_count }} projects</small>
                                </div>
                                <div class="progress" style="width: 100px; height: 8px;">
                                    <div class="progress-bar" role="progressbar" 
                                         style="width: {{ ($category->projects_count / $topData['top_categories']->max('projects_count')) * 100 }}%">
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">No categories found</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Upcoming Events -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Upcoming Events</h4>
                    </div>
                    <div class="card-body">
                        @forelse($topData['upcoming_events'] as $event)
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="mb-0">{{ $event->title }}</h6>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar"></i> 
                                        {{ $event->event_date->format('M d, Y') }}
                                    </small>
                                </div>
                                <span class="badge badge-{{ $event->status === 'published' ? 'success' : 'warning' }}">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </div>
                        @empty
                            <p class="text-muted">No upcoming events</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Donations and Purchases -->
        <div class="row">
            <!-- Recent Donations -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Recent Donations</h4>
                    </div>
                    <div class="card-body">
                        @forelse($topData['recent_donations'] as $donation)
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="mb-0">{{ $donation->donor_name ?? $donation->user->name ?? 'Anonymous' }}</h6>
                                    <small class="text-muted">
                                        {{ $donation->project_name ?? $donation->project->title ?? 'Project' }} - 
                                        ₹{{ number_format($donation->amount, 2) }}
                                    </small>
                                </div>
                                <div class="text-right">
                                    <span class="badge badge-{{ $donation->status === 'completed' ? 'success' : ($donation->status === 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($donation->status) }}
                                    </span>
                                    <br>
                                    <small class="text-muted">{{ $donation->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">No recent donations found</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Recent Package Purchases -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Recent Package Purchases</h4>
                    </div>
                    <div class="card-body">
                        @forelse($topData['recent_purchases'] as $purchase)
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="mb-0">{{ $purchase->user->name ?? $purchase->email }}</h6>
                                    <small class="text-muted">
                                        {{ $purchase->package_name ?? $purchase->package->name ?? 'Package' }} - 
                                        ₹{{ number_format($purchase->amount, 2) }}
                                    </small>
                                </div>
                                <div class="text-right">
                                    <span class="badge badge-{{ $purchase->status === 'completed' ? 'success' : ($purchase->status === 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($purchase->status) }}
                                    </span>
                                    <br>
                                    <small class="text-muted">{{ $purchase->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">No recent purchases found</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Quick Actions</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('projects.create') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-plus"></i> Add Project
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('events.create') }}" class="btn btn-success btn-block">
                                    <i class="fas fa-calendar-plus"></i> Add Event
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('galleries.create') }}" class="btn btn-info btn-block">
                                    <i class="fas fa-images"></i> Add Gallery
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('admin.contact.index') }}" class="btn btn-warning btn-block">
                                    <i class="fas fa-envelope"></i> View Contacts
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('admin.donations.index') }}" class="btn btn-danger btn-block">
                                    <i class="fas fa-heart"></i> Donations
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('admin.donations.user-packages') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-shopping-cart"></i> User Packages
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('admin.donations.project-donations') }}" class="btn btn-success btn-block">
                                    <i class="fas fa-donate"></i> Project Donations
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('admin.landing-donations.index') }}" class="btn btn-secondary btn-block">
                                    <i class="fas fa-globe"></i> Landing Donations
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('admin.certificates.index') }}" class="btn btn-info btn-block">
                                    <i class="fas fa-certificate"></i> Certificates
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Activity Chart
    const ctx = document.getElementById('activityChart').getContext('2d');
    const activityChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartData['months']),
            datasets: [{
                label: 'Projects',
                data: @json($chartData['projects']),
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.1
            }, {
                label: 'Events',
                data: @json($chartData['events']),
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                tension: 0.1
            }, {
                label: 'Users',
                data: @json($chartData['users']),
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                tension: 0.1
            }, {
                label: 'Contacts',
                data: @json($chartData['contacts']),
                borderColor: 'rgb(255, 205, 86)',
                backgroundColor: 'rgba(255, 205, 86, 0.2)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Activity Trends Over Time'
                }
            }
        }
    });

    // Auto-refresh stats every 5 minutes
    setInterval(function() {
        fetch('{{ route("admin.dashboard") }}?ajax=1')
            .then(response => response.json())
            .then(data => {
                // Update charts or stats if needed
                console.log('Stats refreshed');
            })
            .catch(error => console.log('Error refreshing stats:', error));
    }, 300000); // 5 minutes
});
</script>
@endsection