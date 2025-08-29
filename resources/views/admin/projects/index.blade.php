@extends('admin.master.master')

@section('content')
<div class="main-content">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Projects</h3>
                </div>
                <div class="col-auto">
                    <a href="{{ route('projects.create') }}" class="btn btn-primary">Create Project</a>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
            </div>
        @endif

        <!-- Filter Form -->
        <div class="row mb-4">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form id="filter-form" method="GET" action="{{ route('projects.index') }}">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filter-title">Title</label>
                                        <input type="text" class="form-control" id="filter-title" name="title" value="{{ request('title') }}" placeholder="Filter by Title">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filter-category">Category</label>
                                        <select class="form-control" id="filter-category" name="category_id">
                                            <option value="">All Categories</option>
                                            <!-- Assuming categories exist in your system -->
                                            @foreach (\App\Models\Category::all() as $category)
                                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filter-status">Status</label>
                                        <select class="form-control" id="filter-status" name="status">
                                            <option value="">All Statuses</option>
                                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filter-featured">Featured</label>
                                        <select class="form-control" id="filter-featured" name="is_featured">
                                            <option value="">All</option>
                                            <option value="1" {{ request('is_featured') == '1' ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ request('is_featured') == '0' ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                                    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Clear Filters</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Project Table -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0" id="projects-table">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Featured</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $project)
                                    <tr class="project-row">
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="title">{{ $project->title }}</td>
                                        <td class="category">{{ $project->category ? $project->category->name : 'N/A' }}</td>
                                        <td class="status">{{ ucfirst($project->status) }}</td>
                                        <td class="is-featured">{{ $project->is_featured ? 'Yes' : 'No' }}</td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a href="{{ route('projects.show', $project) }}" class="btn btn-sm btn-primary mr-2">View</a>
                                                <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-info mr-2">Edit</a>
                                                <form action="{{ route('projects.destroy', $project) }}" method="POST" class="delete-form" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $projects->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle delete button clicks with SweetAlert
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
                if (!csrfTokenMeta) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'CSRF token not found. Please refresh the page or contact support.',
                        icon: 'error'
                    });
                    return;
                }
                const csrfToken = csrfTokenMeta.content;
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to delete this project?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form via AJAX
                        fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: new FormData(form)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: data.success,
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: data.error || 'Failed to delete the project.',
                                    icon: 'error'
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Failed to delete the project.',
                                icon: 'error'
                            });
                        });
                    }
                });
            });
        });
    });
</script>
@endsection