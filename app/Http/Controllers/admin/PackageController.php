<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $query = Package::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('duration_type')) {
            $query->where('duration_type', $request->duration_type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('is_featured')) {
            $query->where('is_featured', $request->is_featured);
        }

        $packages = $query->orderBy('sort_order')->paginate(10);

        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|max:10',
            'duration_type' => 'nullable|string|max:255',
            'duration_value' => 'nullable|integer|min:1',
            'perks.*' => 'nullable|string',
            'goodies_count' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with([
                'error' => 'Failed to create package. Please check the input fields.'
            ]);
        }

        $data = $request->all();

        // Generate slug from name if name exists
        if ($request->filled('name')) {
            $slug = Str::slug($request->name);
            // Ensure unique slug
            $count = Package::where('slug', $slug)->count();
            if ($count > 0) {
                $slug .= '-' . ($count + 1);
            }
            $data['slug'] = $slug;
        }

        $packageFolder = public_path('packages/' . ($data['slug'] ?? 'package-' . time()));
        if (!File::exists($packageFolder)) {
            File::makeDirectory($packageFolder, 0755, true);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_image_' . $image->getClientOriginalName();
            $image->move($packageFolder, $filename);
            $data['image'] = 'packages/' . basename($packageFolder) . '/' . $filename;
        }

        // Handle icon upload
        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $filename = time() . '_icon_' . $icon->getClientOriginalName();
            $icon->move($packageFolder, $filename);
            $data['icon'] = 'packages/' . basename($packageFolder) . '/' . $filename;
        }

        // Handle perks
        $data['perks'] = $request->perks ?? [];

        Package::create($data);

        return redirect()->route('packages.index')->with([
            'success' => 'Package created successfully!'
        ]);
    }

    public function show(Package $package)
    {
        return view('admin.packages.show', compact('package'));
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|max:10',
            'duration_type' => 'nullable|string|max:255',
            'duration_value' => 'nullable|integer|min:1',
            'perks.*' => 'nullable|string',
            'goodies_count' => 'nullable|integer|min:0',
            'new_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'new_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with([
                'error' => 'Failed to update package. Please check the input fields.'
            ]);
        }

        $data = $request->all();

        // Generate new slug if name changed
        if ($request->filled('name')) {
            $newSlug = Str::slug($request->name);
            $oldSlug = $package->slug;
            if ($newSlug !== $oldSlug) {
                $count = Package::where('slug', $newSlug)->where('id', '!=', $package->id)->count();
                if ($count > 0) {
                    $newSlug .= '-' . ($count + 1);
                }
                $data['slug'] = $newSlug;

                // Move package folder if slug changed
                $oldFolder = public_path('packages/' . $oldSlug);
                $newFolder = public_path('packages/' . $newSlug);
                if (File::exists($oldFolder)) {
                    File::move($oldFolder, $newFolder);
                }
            } else {
                $newSlug = $oldSlug;
            }
        } else {
            $newSlug = $package->slug ?? 'package-' . $package->id;
        }

        $packageFolder = public_path('packages/' . $newSlug);
        if (!File::exists($packageFolder)) {
            File::makeDirectory($packageFolder, 0755, true);
        }

        // Handle image upload
        if ($request->hasFile('new_image')) {
            // Delete old image if exists
            if ($package->image) {
                $oldImagePath = public_path($package->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            $image = $request->file('new_image');
            $filename = time() . '_image_' . $image->getClientOriginalName();
            $image->move($packageFolder, $filename);
            $data['image'] = 'packages/' . $newSlug . '/' . $filename;
        } elseif ($newSlug !== ($package->slug ?? '') && $package->image) {
            $data['image'] = str_replace('packages/' . $package->slug, 'packages/' . $newSlug, $package->image);
        }

        // Handle icon upload
        if ($request->hasFile('new_icon')) {
            // Delete old icon if exists
            if ($package->icon) {
                $oldIconPath = public_path($package->icon);
                if (File::exists($oldIconPath)) {
                    File::delete($oldIconPath);
                }
            }
            $icon = $request->file('new_icon');
            $filename = time() . '_icon_' . $icon->getClientOriginalName();
            $icon->move($packageFolder, $filename);
            $data['icon'] = 'packages/' . $newSlug . '/' . $filename;
        } elseif ($newSlug !== ($package->slug ?? '') && $package->icon) {
            $data['icon'] = str_replace('packages/' . $package->slug, 'packages/' . $newSlug, $package->icon);
        }

        // Handle perks
        $data['perks'] = $request->perks ?? [];

        $package->update($data);

        return redirect()->route('packages.index')->with([
            'success' => 'Package updated successfully!'
        ]);
    }

    public function destroy(Package $package)
    {
        try {
            // Delete package folder
            $packageFolder = public_path('packages/' . $package->slug);
            if (File::exists($packageFolder)) {
                File::deleteDirectory($packageFolder);
            }
            $package->delete();
            return response()->json(['success' => 'Package deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete the package.'], 500);
        }
    }
}
