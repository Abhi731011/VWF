@extends('admin.master.master')

@section('title', 'Create Certificate Design')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Create Certificate Design</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.certificate-designs.index') }}">Certificate Designs</a></div>
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Design Information</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.certificate-designs.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Design Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                   name="name" value="{{ old('name') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="organization_name">Organization Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('organization_name') is-invalid @enderror" 
                                                   name="organization_name" value="{{ old('organization_name', 'Vaishvik Welfare Foundation') }}" required>
                                            @error('organization_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              name="description" rows="3">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="organization_logo">Organization Logo</label>
                                            <input type="file" class="form-control @error('organization_logo') is-invalid @enderror" 
                                                   name="organization_logo" accept="image/*">
                                            @error('organization_logo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="signature_image">Signature Image</label>
                                            <input type="file" class="form-control @error('signature_image') is-invalid @enderror" 
                                                   name="signature_image" accept="image/*">
                                            @error('signature_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="signature_name">Signature Name</label>
                                            <input type="text" class="form-control @error('signature_name') is-invalid @enderror" 
                                                   name="signature_name" value="{{ old('signature_name') }}">
                                            @error('signature_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="signature_title">Signature Title</label>
                                            <input type="text" class="form-control @error('signature_title') is-invalid @enderror" 
                                                   name="signature_title" value="{{ old('signature_title') }}">
                                            @error('signature_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <h5 class="mt-4 mb-3">Color Settings</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="background_color">Background Color <span class="text-danger">*</span></label>
                                            <input type="color" class="form-control @error('background_color') is-invalid @enderror" 
                                                   name="background_color" value="{{ old('background_color', '#ffffff') }}" required>
                                            @error('background_color')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="border_color">Border Color <span class="text-danger">*</span></label>
                                            <input type="color" class="form-control @error('border_color') is-invalid @enderror" 
                                                   name="border_color" value="{{ old('border_color', '#000000') }}" required>
                                            @error('border_color')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="text_color">Text Color <span class="text-danger">*</span></label>
                                            <input type="color" class="form-control @error('text_color') is-invalid @enderror" 
                                                   name="text_color" value="{{ old('text_color', '#000000') }}" required>
                                            @error('text_color')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title_color">Title Color <span class="text-danger">*</span></label>
                                            <input type="color" class="form-control @error('title_color') is-invalid @enderror" 
                                                   name="title_color" value="{{ old('title_color', '#000000') }}" required>
                                            @error('title_color')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="organization_color">Organization Color <span class="text-danger">*</span></label>
                                            <input type="color" class="form-control @error('organization_color') is-invalid @enderror" 
                                                   name="organization_color" value="{{ old('organization_color', '#000000') }}" required>
                                            @error('organization_color')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <h5 class="mt-4 mb-3">Typography Settings</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="font_family">Font Family <span class="text-danger">*</span></label>
                                            <select class="form-control @error('font_family') is-invalid @enderror" name="font_family" required>
                                                <option value="serif" {{ old('font_family', 'serif') == 'serif' ? 'selected' : '' }}>Serif</option>
                                                <option value="sans-serif" {{ old('font_family') == 'sans-serif' ? 'selected' : '' }}>Sans Serif</option>
                                                <option value="monospace" {{ old('font_family') == 'monospace' ? 'selected' : '' }}>Monospace</option>
                                                <option value="cursive" {{ old('font_family') == 'cursive' ? 'selected' : '' }}>Cursive</option>
                                            </select>
                                            @error('font_family')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="border_width">Border Width <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('border_width') is-invalid @enderror" 
                                                   name="border_width" value="{{ old('border_width', 3) }}" min="1" max="20" required>
                                            @error('border_width')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="title_font_size">Title Font Size <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('title_font_size') is-invalid @enderror" 
                                                   name="title_font_size" value="{{ old('title_font_size', 36) }}" min="12" max="72" required>
                                            @error('title_font_size')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="name_font_size">Name Font Size <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('name_font_size') is-invalid @enderror" 
                                                   name="name_font_size" value="{{ old('name_font_size', 28) }}" min="12" max="72" required>
                                            @error('name_font_size')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="organization_font_size">Organization Font Size <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('organization_font_size') is-invalid @enderror" 
                                                   name="organization_font_size" value="{{ old('organization_font_size', 18) }}" min="8" max="48" required>
                                            @error('organization_font_size')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="signature_font_size">Signature Font Size <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('signature_font_size') is-invalid @enderror" 
                                                   name="signature_font_size" value="{{ old('signature_font_size', 16) }}" min="8" max="48" required>
                                            @error('signature_font_size')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="custom_css">Custom CSS</label>
                                    <textarea class="form-control @error('custom_css') is-invalid @enderror" 
                                              name="custom_css" rows="5" placeholder="Add custom CSS styles here...">{{ old('custom_css') }}</textarea>
                                    @error('custom_css')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_active" value="1" 
                                                       id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="is_active">Active</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="is_default" value="1" 
                                                       id="is_default" {{ old('is_default') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="is_default">Set as Default</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Create Design
                                    </button>
                                    <a href="{{ route('admin.certificate-designs.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Back
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
