@extends('admin.master.master')

@section('title', 'Certificate Requests')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Certificate Requests</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Certificate Requests</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Certificate Requests</h4>
                            <div class="card-header-form">
                                <form method="GET" action="{{ route('admin.certificates.index') }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="full_name" placeholder="Search by name" value="{{ request('full_name') }}">
                                        <input type="text" class="form-control" name="email" placeholder="Search by email" value="{{ request('email') }}">
                                        <select class="form-control" name="status">
                                            <option value="">All Status</option>
                                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Certificate ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Requested Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($certificateRequests as $request)
                                        <tr>
                                            <td>{{ $request->id }}</td>
                                            <td>
                                                @if($request->certificate_id)
                                                    <span class="badge badge-light">{{ $request->certificate_id }}</span>
                                                @else
                                                    <span class="text-muted">Not Generated</span>
                                                @endif
                                            </td>
                                            <td>{{ $request->full_name }}</td>
                                            <td>{{ $request->email }}</td>
                                            <td>{{ $request->phone ?? 'N/A' }}</td>
                                            <td>
                                                @if($request->status == 'pending')
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif($request->status == 'approved')
                                                    <span class="badge badge-success">Approved</span>
                                                @else
                                                    <span class="badge badge-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td>{{ $request->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.certificates.show', $request) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No certificate requests found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">
                                {{ $certificateRequests->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
