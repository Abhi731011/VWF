<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $galleries = $query->orderBy('sort_order')->paginate(10);

        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'image_descriptions.*' => 'nullable|string|max:500',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with([
                'error' => 'Failed to create gallery. Please check the input fields.'
            ]);
        }

        $data = $request->all();

        // Create gallery folder
        $galleryFolder = public_path('gallery');
        if (!File::exists($galleryFolder)) {
            File::makeDirectory($galleryFolder, 0755, true);
        }

        // Handle multiple image uploads
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                if ($image) {
                    $filename = time() . '_' . $index . '_' . $image->getClientOriginalName();
                    $image->move($galleryFolder, $filename);
                    
                    $images[] = [
                        'image' => 'gallery/' . $filename,
                        'description' => $request->image_descriptions[$index] ?? ''
                    ];
                }
            }
        }

        $data['images'] = $images;
        $data['status'] = $request->has('status') ? true : false;

        Gallery::create($data);

        return redirect()->route('galleries.index')->with([
            'success' => 'Gallery created successfully!'
        ]);
    }

    public function show(Gallery $gallery)
    {
        return view('admin.galleries.show', compact('gallery'));
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'new_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'new_image_descriptions.*' => 'nullable|string|max:500',
            'existing_image_descriptions.*' => 'nullable|string|max:500',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with([
                'error' => 'Failed to update gallery. Please check the input fields.'
            ]);
        }

        $data = $request->all();

        // Create gallery folder
        $galleryFolder = public_path('gallery');
        if (!File::exists($galleryFolder)) {
            File::makeDirectory($galleryFolder, 0755, true);
        }

        // Update existing images descriptions
        $existingImages = $gallery->images ?? [];
        if ($request->has('existing_image_descriptions')) {
            foreach ($existingImages as $index => &$imageData) {
                if (isset($request->existing_image_descriptions[$index])) {
                    $imageData['description'] = $request->existing_image_descriptions[$index];
                }
            }
        }

        // Handle new image uploads
        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $index => $image) {
                if ($image) {
                    $filename = time() . '_' . $index . '_' . $image->getClientOriginalName();
                    $image->move($galleryFolder, $filename);
                    
                    $existingImages[] = [
                        'image' => 'gallery/' . $filename,
                        'description' => $request->new_image_descriptions[$index] ?? ''
                    ];
                }
            }
        }

        $data['images'] = $existingImages;
        $data['status'] = $request->has('status') ? true : false;

        $gallery->update($data);

        return redirect()->route('galleries.index')->with([
            'success' => 'Gallery updated successfully!'
        ]);
    }

    public function destroy(Gallery $gallery)
    {
        try {
            // Delete gallery images
            if ($gallery->images) {
                foreach ($gallery->images as $imageData) {
                    if (isset($imageData['image'])) {
                        $imagePath = public_path($imageData['image']);
                        if (File::exists($imagePath)) {
                            File::delete($imagePath);
                        }
                    }
                }
            }
            
            $gallery->delete();
            return response()->json(['success' => 'Gallery deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete the gallery.'], 500);
        }
    }
}
