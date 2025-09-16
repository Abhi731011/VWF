@extends('admin.master.master')

@section('title', 'Certificate Design Details')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Certificate Design Details</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.certificate-designs.index') }}">Certificate Designs</a></div>
                <div class="breadcrumb-item">Details</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $certificateDesign->name }}</h4>
                            <div class="card-header-action">
                                @if($certificateDesign->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-secondary">Inactive</span>
                                @endif
                                @if($certificateDesign->is_default)
                                    <span class="badge badge-primary">Default</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Design Name:</strong></label>
                                        <p>{{ $certificateDesign->name }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Description:</strong></label>
                                        <p>{{ $certificateDesign->description ?? 'No description provided' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Organization Name:</strong></label>
                                        <p>{{ $certificateDesign->organization_name }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Font Family:</strong></label>
                                        <p>{{ ucfirst($certificateDesign->font_family) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Border Width:</strong></label>
                                        <p>{{ $certificateDesign->border_width }}px</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Title Font Size:</strong></label>
                                        <p>{{ $certificateDesign->title_font_size }}px</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Name Font Size:</strong></label>
                                        <p>{{ $certificateDesign->name_font_size }}px</p>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Created:</strong></label>
                                        <p>{{ $certificateDesign->created_at->format('M d, Y H:i A') }}</p>
                                    </div>
                                </div>
                            </div>

                            <h5 class="mt-4 mb-3">Color Settings</h5>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label><strong>Background:</strong></label>
                                        <div style="width: 50px; height: 30px; background-color: {{ $certificateDesign->background_color }}; border: 1px solid #ccc;"></div>
                                        <small>{{ $certificateDesign->background_color }}</small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label><strong>Border:</strong></label>
                                        <div style="width: 50px; height: 30px; background-color: {{ $certificateDesign->border_color }}; border: 1px solid #ccc;"></div>
                                        <small>{{ $certificateDesign->border_color }}</small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label><strong>Text:</strong></label>
                                        <div style="width: 50px; height: 30px; background-color: {{ $certificateDesign->text_color }}; border: 1px solid #ccc;"></div>
                                        <small>{{ $certificateDesign->text_color }}</small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label><strong>Title:</strong></label>
                                        <div style="width: 50px; height: 30px; background-color: {{ $certificateDesign->title_color }}; border: 1px solid #ccc;"></div>
                                        <small>{{ $certificateDesign->title_color }}</small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label><strong>Organization:</strong></label>
                                        <div style="width: 50px; height: 30px; background-color: {{ $certificateDesign->organization_color }}; border: 1px solid #ccc;"></div>
                                        <small>{{ $certificateDesign->organization_color }}</small>
                                    </div>
                                </div>
                            </div>

                            @if($certificateDesign->organization_logo)
                            <div class="form-group">
                                <label><strong>Organization Logo:</strong></label>
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $certificateDesign->organization_logo) }}" alt="Organization Logo" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            </div>
                            @endif

                            @if($certificateDesign->signature_image)
                            <div class="form-group">
                                <label><strong>Signature Image:</strong></label>
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $certificateDesign->signature_image) }}" alt="Signature" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            </div>
                            @endif

                            @if($certificateDesign->signature_name || $certificateDesign->signature_title)
                            <div class="form-group">
                                <label><strong>Signature Details:</strong></label>
                                <p><strong>Name:</strong> {{ $certificateDesign->signature_name ?? 'N/A' }}</p>
                                <p><strong>Title:</strong> {{ $certificateDesign->signature_title ?? 'N/A' }}</p>
                            </div>
                            @endif

                            @if($certificateDesign->custom_css)
                            <div class="form-group">
                                <label><strong>Custom CSS:</strong></label>
                                <pre class="bg-light p-3"><code>{{ $certificateDesign->custom_css }}</code></pre>
                            </div>
                            @endif

                            <div class="form-group">
                                <a href="{{ route('admin.certificate-designs.edit', $certificateDesign) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit Design
                                </a>
                                <a href="{{ route('admin.certificate-designs.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back to List
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
