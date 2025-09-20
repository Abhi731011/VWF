@extends('admin.master.master')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>User Packages</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.donations.index') }}">Donations</a></div>
                <div class="breadcrumb-item">User Packages</div>
            </div>
        </div>

        <!-- Filters -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Filter Package Purchases</h4>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.donations.user-packages') }}" class="form-inline">
                            <div class="form-group mr-3 mb-2">
                                <label for="search" class="mr-2">Search:</label>
                                <input type="text" class="form-control" id="search" name="search" 
                                       value="{{ request('search') }}" placeholder="Name, email, package...">
                            </div>
                            
                            <div class="form-group mr-3 mb-2">
                                <label for="status" class="mr-2">Status:</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="">All Status</option>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mr-3 mb-2">
                                <label for="package_id" class="mr-2">Package:</label>
                                <select class="form-control" id="package_id" name="package_id">
                                    <option value="">All Packages</option>
                                    @foreach($packagesList as $package)
                                        <option value="{{ $package->id }}" {{ request('package_id') == $package->id ? 'selected' : '' }}>
                                            {{ $package->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mr-3 mb-2">
                                <label for="date_from" class="mr-2">From:</label>
                                <input type="date" class="form-control" id="date_from" name="date_from" 
                                       value="{{ request('date_from') }}">
                            </div>

                            <div class="form-group mr-3 mb-2">
                                <label for="date_to" class="mr-2">To:</label>
                                <input type="date" class="form-control" id="date_to" name="date_to" 
                                       value="{{ request('date_to') }}">
                            </div>

                            <div class="form-group mr-3 mb-2">
                                <label for="amount_min" class="mr-2">Min Amount:</label>
                                <input type="number" class="form-control" id="amount_min" name="amount_min" 
                                       value="{{ request('amount_min') }}" placeholder="0" step="0.01">
                            </div>

                            <div class="form-group mr-3 mb-2">
                                <label for="amount_max" class="mr-2">Max Amount:</label>
                                <input type="number" class="form-control" id="amount_max" name="amount_max" 
                                       value="{{ request('amount_max') }}" placeholder="10000" step="0.01">
                            </div>

                            <div class="form-group mb-2">
                                <button type="submit" class="btn btn-primary mr-2">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                                <a href="{{ route('admin.donations.user-packages') }}" class="btn btn-secondary">
                                    <i class="fas fa-refresh"></i> Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Package Purchases Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Package Purchases ({{ $packages->total() }} total)</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Email</th>
                                        <th>Package</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Purchase Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($packages as $package)
                                        <tr>
                                            <td>{{ $package->id }}</td>
                                            <td>
                                                @if($package->user)
                                                    <div class="d-flex align-items-center">
                                                        @if($package->user->profile_img)
                                                            <img src="{{ asset('admin_profile/' . $package->user->profile_img) }}" 
                                                                 alt="{{ $package->user->name }}" 
                                                                 class="rounded-circle mr-2" 
                                                                 width="30" height="30">
                                                        @else
                                                            <div class="avatar bg-primary text-white rounded-circle mr-2 d-flex align-items-center justify-content-center" 
                                                                 style="width: 30px; height: 30px;">
                                                                {{ substr($package->user->name, 0, 1) }}
                                                            </div>
                                                        @endif
                                                        <div>
                                                            <strong>{{ $package->user->name }}</strong>
                                                            @if($package->user->phone)
                                                                <br><small class="text-muted">{{ $package->user->phone }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-muted">Guest User</span>
                                                @endif
                                            </td>
                                            <td>{{ $package->email }}</td>
                                            <td>
                                                <div>
                                                    <strong>{{ $package->package_name ?? $package->package->name ?? 'N/A' }}</strong>
                                                    @if($package->package)
                                                        <br><small class="text-muted">{{ $package->package->description }}</small>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <strong>₹{{ number_format($package->amount, 2) }}</strong>
                                                <br><small class="text-muted">{{ $package->currency }}</small>
                                            </td>
                                            <td>
                                                <span class="badge badge-{{ $package->status === 'completed' ? 'success' : ($package->status === 'pending' ? 'warning' : 'danger') }}">
                                                    {{ ucfirst($package->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                {{ $package->created_at->format('M d, Y') }}
                                                <br><small class="text-muted">{{ $package->created_at->format('h:i A') }}</small>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.donations.show-package-purchase', $package) }}" 
                                                   class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">
                                                <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                                                <p>No package purchases found</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($packages->hasPages())
                            <div class="d-flex justify-content-center">
                                {{ $packages->appends(request()->query())->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
