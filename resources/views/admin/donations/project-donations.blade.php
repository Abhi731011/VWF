@extends('admin.master.master')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Project Donations</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.donations.index') }}">Donations</a></div>
                <div class="breadcrumb-item">Project Donations</div>
            </div>
        </div>

        <!-- Filters -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Filter Project Donations</h4>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.donations.project-donations') }}" class="form-inline">
                            <div class="form-group mr-3 mb-2">
                                <label for="search" class="mr-2">Search:</label>
                                <input type="text" class="form-control" id="search" name="search" 
                                       value="{{ request('search') }}" placeholder="Donor, project, email...">
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
                                <label for="project_id" class="mr-2">Project:</label>
                                <select class="form-control" id="project_id" name="project_id">
                                    <option value="">All Projects</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                                            {{ $project->title }}
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

                            <div class="form-group mr-3 mb-2">
                                <label for="is_anonymous" class="mr-2">Anonymous:</label>
                                <select class="form-control" id="is_anonymous" name="is_anonymous">
                                    <option value="">All</option>
                                    <option value="1" {{ request('is_anonymous') == '1' ? 'selected' : '' }}>Anonymous Only</option>
                                    <option value="0" {{ request('is_anonymous') == '0' ? 'selected' : '' }}>Named Only</option>
                                </select>
                            </div>

                            <div class="form-group mb-2">
                                <button type="submit" class="btn btn-primary mr-2">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                                <a href="{{ route('admin.donations.project-donations') }}" class="btn btn-secondary">
                                    <i class="fas fa-refresh"></i> Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Donations Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Project Donations ({{ $donations->total() }} total)</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Donor</th>
                                        <th>Email</th>
                                        <th>Project</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Anonymous</th>
                                        <th>Donation Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($donations as $donation)
                                        <tr>
                                            <td>{{ $donation->id }}</td>
                                            <td>
                                                @if($donation->is_anonymous)
                                                    <span class="text-muted">
                                                        <i class="fas fa-user-secret"></i> Anonymous
                                                    </span>
                                                @elseif($donation->user)
                                                    <div class="d-flex align-items-center">
                                                        @if($donation->user->profile_img)
                                                            <img src="{{ asset('admin_profile/' . $donation->user->profile_img) }}" 
                                                                 alt="{{ $donation->user->name }}" 
                                                                 class="rounded-circle mr-2" 
                                                                 width="30" height="30">
                                                        @else
                                                            <div class="avatar bg-primary text-white rounded-circle mr-2 d-flex align-items-center justify-content-center" 
                                                                 style="width: 30px; height: 30px;">
                                                                {{ substr($donation->user->name, 0, 1) }}
                                                            </div>
                                                        @endif
                                                        <div>
                                                            <strong>{{ $donation->donor_name ?? $donation->user->name }}</strong>
                                                            @if($donation->donor_phone || $donation->user->phone)
                                                                <br><small class="text-muted">{{ $donation->donor_phone ?? $donation->user->phone }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @else
                                                    <div>
                                                        <strong>{{ $donation->donor_name ?? 'Guest Donor' }}</strong>
                                                        @if($donation->donor_phone)
                                                            <br><small class="text-muted">{{ $donation->donor_phone }}</small>
                                                        @endif
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $donation->donor_email ?? $donation->user->email ?? 'N/A' }}</td>
                                            <td>
                                                <div>
                                                    <strong>{{ $donation->project_name ?? $donation->project->title ?? 'N/A' }}</strong>
                                                    @if($donation->project)
                                                        <br><small class="text-muted">{{ Str::limit($donation->project->description, 50) }}</small>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <strong>₹{{ number_format($donation->amount, 2) }}</strong>
                                                <br><small class="text-muted">{{ $donation->currency }}</small>
                                            </td>
                                            <td>
                                                <span class="badge badge-{{ $donation->status === 'completed' ? 'success' : ($donation->status === 'pending' ? 'warning' : 'danger') }}">
                                                    {{ ucfirst($donation->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($donation->is_anonymous)
                                                    <span class="badge badge-info">
                                                        <i class="fas fa-user-secret"></i> Anonymous
                                                    </span>
                                                @else
                                                    <span class="badge badge-secondary">
                                                        <i class="fas fa-user"></i> Named
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $donation->created_at->format('M d, Y') }}
                                                <br><small class="text-muted">{{ $donation->created_at->format('h:i A') }}</small>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.donations.show-donation', $donation) }}" 
                                                   class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-muted">
                                                <i class="fas fa-heart fa-3x mb-3"></i>
                                                <p>No donations found</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($donations->hasPages())
                            <div class="d-flex justify-content-center">
                                {{ $donations->appends(request()->query())->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
