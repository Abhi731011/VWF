<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('is_featured')) {
            $query->where('is_featured', $request->is_featured);
        }

        $projects = $query->paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags.*' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4,avi,mov|max:10240',
            'target_amount' => 'nullable|numeric|min:0',
            'min_donation' => 'nullable|numeric|min:0',
            'end_date' => 'nullable|date',
            'is_recurring' => 'nullable|boolean',
            'organizer_name' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'status' => 'nullable|in:draft,archived,published',
            'is_featured' => 'nullable|boolean',
            'visibility' => 'nullable|boolean',
            'location' => 'nullable|string|max:255',
            'documents.*' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'faqs.*.question' => 'nullable|string',
            'faqs.*.answer' => 'nullable|string',
            'updates.*.date' => 'nullable|date',
            'updates.*.content' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with([
                'error' => 'Failed to create project. Please check the input fields.'
            ]);
        }

        $data = $request->all();
        $slug = Str::slug($request->title);
        // Ensure unique slug
        $count = Project::where('slug', $slug)->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }
        $data['slug'] = $slug;

        $projectFolder = public_path('projects/' . $slug);
        if (!File::exists($projectFolder)) {
            File::makeDirectory($projectFolder, 0755, true);
        }

        // Handle images
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move($projectFolder, $filename);
                $images[] = 'projects/' . $slug . '/' . $filename;
            }
        }
        $data['images'] = $images;

        // Handle documents
        $documents = [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $document) {
                $filename = time() . '_' . $document->getClientOriginalName();
                $document->move($projectFolder, $filename);
                $documents[] = 'projects/' . $slug . '/' . $filename;
            }
        }
        $data['documents'] = $documents;

        // Handle video_file
        if ($request->hasFile('video_file')) {
            $filename = time() . '_' . $request->file('video_file')->getClientOriginalName();
            $request->file('video_file')->move($projectFolder, $filename);
            $data['video_file'] = 'projects/' . $slug . '/' . $filename;
        }

        // Handle tags
        $data['tags'] = $request->tags ?? [];

        // Handle faqs
        $faqs = [];
        if ($request->has('faqs')) {
            foreach ($request->faqs as $faq) {
                if (!empty($faq['question']) || !empty($faq['answer'])) {
                    $faqs[] = ['question' => $faq['question'] ?? '', 'answer' => $faq['answer'] ?? ''];
                }
            }
        }
        $data['faqs'] = $faqs;

        // Handle updates
        $updates = [];
        if ($request->has('updates')) {
            foreach ($request->updates as $update) {
                if (!empty($update['date']) || !empty($update['content'])) {
                    $updates[] = ['date' => $update['date'] ?? '', 'content' => $update['content'] ?? ''];
                }
            }
        }
        $data['updates'] = $updates;

        Project::create($data);

        return redirect()->route('projects.index')->with([
            'success' => 'Project created successfully!'
        ]);
    }

    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags.*' => 'nullable|string',
            'new_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4,avi,mov|max:10240',
            'target_amount' => 'nullable|numeric|min:0',
            'min_donation' => 'nullable|numeric|min:0',
            'end_date' => 'nullable|date',
            'is_recurring' => 'nullable|boolean',
            'organizer_name' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'status' => 'nullable|in:draft,archived,published',
            'is_featured' => 'nullable|boolean',
            'visibility' => 'nullable|boolean',
            'location' => 'nullable|string|max:255',
            'new_documents.*' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'faqs.*.question' => 'nullable|string',
            'faqs.*.answer' => 'nullable|string',
            'updates.*.date' => 'nullable|date',
            'updates.*.content' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with([
                'error' => 'Failed to update project. Please check the input fields.'
            ]);
        }

        $data = $request->all();
        $newSlug = Str::slug($request->title);
        $oldSlug = $project->slug;
        if ($newSlug !== $oldSlug) {
            $count = Project::where('slug', $newSlug)->where('id', '!=', $project->id)->count();
            if ($count > 0) {
                $newSlug .= '-' . ($count + 1);
            }
            $data['slug'] = $newSlug;

            // Move project folder
            $oldFolder = public_path('projects/' . $oldSlug);
            $newFolder = public_path('projects/' . $newSlug);
            if (File::exists($oldFolder)) {
                File::move($oldFolder, $newFolder);
            }
        } else {
            $newSlug = $oldSlug;
        }

        $projectFolder = public_path('projects/' . $newSlug);

        // Handle images
        $images = $project->images ?? [];
        // Delete selected images
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $path) {
                $fullPath = public_path($path);
                if (File::exists($fullPath)) {
                    File::delete($fullPath);
                }
                if (($key = array_search($path, $images)) !== false) {
                    unset($images[$key]);
                }
            }
        }
        // Add new images
        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move($projectFolder, $filename);
                $images[] = 'projects/' . $newSlug . '/' . $filename;
            }
        }
        // Update paths if slug changed
        if ($newSlug !== $oldSlug) {
            foreach ($images as &$path) {
                $path = str_replace('projects/' . $oldSlug, 'projects/' . $newSlug, $path);
            }
        }
        $data['images'] = array_values($images);

        // Handle documents
        $documents = $project->documents ?? [];
        // Delete selected documents
        if ($request->has('delete_documents')) {
            foreach ($request->delete_documents as $path) {
                $fullPath = public_path($path);
                if (File::exists($fullPath)) {
                    File::delete($fullPath);
                }
                if (($key = array_search($path, $documents)) !== false) {
                    unset($documents[$key]);
                }
            }
        }
        // Add new documents
        if ($request->hasFile('new_documents')) {
            foreach ($request->file('new_documents') as $document) {
                $filename = time() . '_' . $document->getClientOriginalName();
                $document->move($projectFolder, $filename);
                $documents[] = 'projects/' . $newSlug . '/' . $filename;
            }
        }
        // Update paths if slug changed
        if ($newSlug !== $oldSlug) {
            foreach ($documents as &$path) {
                $path = str_replace('projects/' . $oldSlug, 'projects/' . $newSlug, $path);
            }
        }
        $data['documents'] = array_values($documents);

        // Handle video_file
        if ($request->hasFile('video_file')) {
            // Delete old video if exists
            if ($project->video_file) {
                $oldVideoPath = public_path($project->video_file);
                if (File::exists($oldVideoPath)) {
                    File::delete($oldVideoPath);
                }
            }
            $filename = time() . '_' . $request->file('video_file')->getClientOriginalName();
            $request->file('video_file')->move($projectFolder, $filename);
            $data['video_file'] = 'projects/' . $newSlug . '/' . $filename;
        } elseif ($newSlug !== $oldSlug && $project->video_file) {
            $data['video_file'] = str_replace('projects/' . $oldSlug, 'projects/' . $newSlug, $project->video_file);
        }

        // Handle tags
        $data['tags'] = $request->tags ?? [];

        // Handle faqs
        $faqs = [];
        if ($request->has('faqs')) {
            foreach ($request->faqs as $faq) {
                if (!empty($faq['question']) || !empty($faq['answer'])) {
                    $faqs[] = ['question' => $faq['question'] ?? '', 'answer' => $faq['answer'] ?? ''];
                }
            }
        }
        $data['faqs'] = $faqs;

        // Handle updates
        $updates = [];
        if ($request->has('updates')) {
            foreach ($request->updates as $update) {
                if (!empty($update['date']) || !empty($update['content'])) {
                    $updates[] = ['date' => $update['date'] ?? '', 'content' => $update['content'] ?? ''];
                }
            }
        }
        $data['updates'] = $updates;

        $project->update($data);

        return redirect()->route('projects.index')->with([
            'success' => 'Project updated successfully!'
        ]);
    }

    public function destroy(Project $project)
    {
        try {
            // Delete project folder
            $projectFolder = public_path('projects/' . $project->slug);
            if (File::exists($projectFolder)) {
                File::deleteDirectory($projectFolder);
            }
            $project->delete();
            return response()->json(['success' => 'Project deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete the project.'], 500);
        }
    }
}