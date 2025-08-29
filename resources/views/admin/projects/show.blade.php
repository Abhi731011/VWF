@extends('admin.master.master')

@section('content')
<div class="main-content">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Project Details</h3>
                </div>
                <div class="col-auto">
                    <a href="{{ route('projects.edit', $project) }}" class="btn btn-info">Edit</a>
                    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Project Details -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Title</h5>
                                <p>{{ $project->title }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Category</h5>
                                <p>{{ $project->category ? $project->category->name : 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Short Description</h5>
                                <p>{{ $project->short_description ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Description</h5>
                                <p>{{ $project->description ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Target Amount</h5>
                                <p>{{ $project->target_amount ? number_format($project->target_amount, 2) : 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Minimum Donation</h5>
                                <p>{{ $project->min_donation ? number_format($project->min_donation, 2) : 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>End Date</h5>
                                <p>{{ $project->end_date ? $project->end_date->format('Y-m-d') : 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Video URL</h5>
                                <p>{{ $project->video_url ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Video File</h5>
                                <p>{{ $project->video_file ? basename($project->video_file) : 'N/A' }}</p>
                                @if ($project->video_file)
                                    <video width="320" height="240" controls>
                                        <source src="{{ asset($project->video_file) }}" type="video/mp4">
                                    </video>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <h5>Organizer Name</h5>
                                <p>{{ $project->organizer_name ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Contact Email</h5>
                                <p>{{ $project->contact_email ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Contact Phone</h5>
                                <p>{{ $project->contact_phone ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Location</h5>
                                <p>{{ $project->location ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Status</h5>
                                <p>{{ ucfirst($project->status ?? 'N/A') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Recurring</h5>
                                <p>{{ $project->is_recurring ? 'Yes' : 'No' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Featured</h5>
                                <p>{{ $project->is_featured ? 'Yes' : 'No' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Visibility</h5>
                                <p>{{ $project->visibility ? 'Visible' : 'Hidden' }}</p>
                            </div>
                            <div class="col-md-12">
                                <h5>Tags</h5>
                                <p>{{ $project->tags ? implode(', ', $project->tags) : 'N/A' }}</p>
                            </div>
                            <div class="col-md-12">
                                <h5>Images</h5>
                                @if ($project->images)
                                    @foreach ($project->images as $image)
                                        <img src="{{ asset($image) }}" alt="Project Image" style="width: 200px; height: auto; margin-right: 10px;">
                                    @endforeach
                                @else
                                    <p>N/A</p>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <h5>Documents</h5>
                                @if ($project->documents)
                                    <ul>
                                        @foreach ($project->documents as $document)
                                            <li><a href="{{ asset($document) }}" target="_blank">{{ basename($document) }}</a></li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>N/A</p>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <h5>FAQs</h5>
                                @if ($project->faqs)
                                    @foreach ($project->faqs as $faq)
                                        <div class="mb-3">
                                            <strong>Question:</strong> {{ $faq['question'] ?? 'N/A' }}<br>
                                            <strong>Answer:</strong> {{ $faq['answer'] ?? 'N/A' }}
                                        </div>
                                    @endforeach
                                @else
                                    <p>N/A</p>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <h5>Updates</h5>
                                @if ($project->updates)
                                    @foreach ($project->updates as $update)
                                        <div class="mb-3">
                                            <strong>Date:</strong> {{ $update['date'] ?? 'N/A' }}<br>
                                            <strong>Content:</strong> {{ $update['content'] ?? 'N/A' }}
                                        </div>
                                    @endforeach
                                @else
                                    <p>N/A</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection