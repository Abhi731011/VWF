@extends('admin.master.master')

@section('title', 'Certificate Designs')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Certificate Designs</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Certificate Designs</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Certificate Designs</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.certificate-designs.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Create New Design
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Organization</th>
                                            <th>Status</th>
                                            <th>Default</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($certificateDesigns as $design)
                                        <tr>
                                            <td>{{ $design->id }}</td>
                                            <td>
                                                <strong>{{ $design->name }}</strong>
                                                @if($design->description)
                                                <br><small class="text-muted">{{ Str::limit($design->description, 50) }}</small>
                                                @endif
                                            </td>
                                            <td>{{ $design->organization_name }}</td>
                                            <td>
                                                @if($design->is_active)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($design->is_default)
                                                    <span class="badge badge-primary">Default</span>
                                                @else
                                                    <form action="{{ route('admin.certificate-designs.set-default', $design) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-outline-primary">Set Default</button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>{{ $design->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.certificate-designs.show', $design) }}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.certificate-designs.edit', $design) }}" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @if(!$design->is_default)
                                                    <form action="{{ route('admin.certificate-designs.destroy', $design) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this design?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No certificate designs found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">
                                {{ $certificateDesigns->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
