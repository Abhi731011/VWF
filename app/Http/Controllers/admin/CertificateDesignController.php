<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CertificateDesign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateDesignController extends Controller
{
    /**
     * Display a listing of certificate designs.
     */
    public function index()
    {
        $certificateDesigns = CertificateDesign::orderBy('is_default', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.certificate-designs.index', compact('certificateDesigns'));
    }

    /**
     * Show the form for creating a new certificate design.
     */
    public function create()
    {
        return view('admin.certificate-designs.create');
    }

    /**
     * Store a newly created certificate design.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'organization_name' => 'required|string|max:255',
            'organization_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'signature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'signature_name' => 'nullable|string|max:255',
            'signature_title' => 'nullable|string|max:255',
            'background_color' => 'required|string',
            'border_color' => 'required|string',
            'text_color' => 'required|string',
            'title_color' => 'required|string',
            'organization_color' => 'required|string',
            'border_width' => 'required|integer|min:1|max:20',
            'font_family' => 'required|string',
            'title_font_size' => 'required|integer|min:12|max:72',
            'name_font_size' => 'required|integer|min:12|max:72',
            'organization_font_size' => 'required|integer|min:8|max:48',
            'signature_font_size' => 'required|integer|min:8|max:48',
            'custom_css' => 'nullable|string',
            'is_active' => 'boolean',
            'is_default' => 'boolean',
        ]);

        $data = $request->all();

        // Handle file uploads
        if ($request->hasFile('organization_logo')) {
            $data['organization_logo'] = $request->file('organization_logo')->store('certificate-designs', 'public');
        }

        if ($request->hasFile('signature_image')) {
            $data['signature_image'] = $request->file('signature_image')->store('certificate-designs', 'public');
        }

        // If this is set as default, remove default from others
        if ($request->boolean('is_default')) {
            CertificateDesign::where('is_default', true)->update(['is_default' => false]);
        }

        CertificateDesign::create($data);

        return redirect()->route('admin.certificate-designs.index')
            ->with('success', 'Certificate design created successfully.');
    }

    /**
     * Display the specified certificate design.
     */
    public function show(CertificateDesign $certificateDesign)
    {
        return view('admin.certificate-designs.show', compact('certificateDesign'));
    }

    /**
     * Show the form for editing the specified certificate design.
     */
    public function edit(CertificateDesign $certificateDesign)
    {
        return view('admin.certificate-designs.edit', compact('certificateDesign'));
    }

    /**
     * Update the specified certificate design.
     */
    public function update(Request $request, CertificateDesign $certificateDesign)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'organization_name' => 'required|string|max:255',
            'organization_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'signature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'signature_name' => 'nullable|string|max:255',
            'signature_title' => 'nullable|string|max:255',
            'background_color' => 'required|string',
            'border_color' => 'required|string',
            'text_color' => 'required|string',
            'title_color' => 'required|string',
            'organization_color' => 'required|string',
            'border_width' => 'required|integer|min:1|max:20',
            'font_family' => 'required|string',
            'title_font_size' => 'required|integer|min:12|max:72',
            'name_font_size' => 'required|integer|min:12|max:72',
            'organization_font_size' => 'required|integer|min:8|max:48',
            'signature_font_size' => 'required|integer|min:8|max:48',
            'custom_css' => 'nullable|string',
            'is_active' => 'boolean',
            'is_default' => 'boolean',
        ]);

        $data = $request->all();

        // Handle file uploads
        if ($request->hasFile('organization_logo')) {
            // Delete old logo
            if ($certificateDesign->organization_logo) {
                Storage::disk('public')->delete($certificateDesign->organization_logo);
            }
            $data['organization_logo'] = $request->file('organization_logo')->store('certificate-designs', 'public');
        }

        if ($request->hasFile('signature_image')) {
            // Delete old signature
            if ($certificateDesign->signature_image) {
                Storage::disk('public')->delete($certificateDesign->signature_image);
            }
            $data['signature_image'] = $request->file('signature_image')->store('certificate-designs', 'public');
        }

        // If this is set as default, remove default from others
        if ($request->boolean('is_default')) {
            CertificateDesign::where('is_default', true)->where('id', '!=', $certificateDesign->id)->update(['is_default' => false]);
        }

        $certificateDesign->update($data);

        return redirect()->route('admin.certificate-designs.index')
            ->with('success', 'Certificate design updated successfully.');
    }

    /**
     * Remove the specified certificate design.
     */
    public function destroy(CertificateDesign $certificateDesign)
    {
        // Don't allow deletion of default design
        if ($certificateDesign->is_default) {
            return redirect()->route('admin.certificate-designs.index')
                ->with('error', 'Cannot delete the default certificate design.');
        }

        // Delete associated files
        if ($certificateDesign->organization_logo) {
            Storage::disk('public')->delete($certificateDesign->organization_logo);
        }
        if ($certificateDesign->signature_image) {
            Storage::disk('public')->delete($certificateDesign->signature_image);
        }

        $certificateDesign->delete();

        return redirect()->route('admin.certificate-designs.index')
            ->with('success', 'Certificate design deleted successfully.');
    }

    /**
     * Set a certificate design as default.
     */
    public function setDefault(CertificateDesign $certificateDesign)
    {
        // Remove default from others
        CertificateDesign::where('is_default', true)->update(['is_default' => false]);
        
        // Set this as default
        $certificateDesign->update(['is_default' => true]);

        return redirect()->route('admin.certificate-designs.index')
            ->with('success', 'Certificate design set as default successfully.');
    }
}
