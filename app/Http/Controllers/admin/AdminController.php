<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Package;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    private function checkMainAdminAccess()
    {
        if (!auth()->check() || !auth()->user()->isMainAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Access denied. Only the main admin can manage admin users.');
        }
        return null;
    }

    public function index(Request $request)
    {
        $accessCheck = $this->checkMainAdminAccess();
        if ($accessCheck) return $accessCheck;

        $query = User::where('admin_id', 1);

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('state')) {
            $query->where('state', 'like', '%' . $request->state . '%');
        }

        if ($request->filled('package_id')) {
            $query->where('package_id', $request->package_id);
        }

        $admins = $query->paginate(10);

        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        $accessCheck = $this->checkMainAdminAccess();
        if ($accessCheck) return $accessCheck;

        $packages = Package::where('status', true)->get();
        return view('admin.admins.create', compact('packages'));
    }

    public function store(Request $request)
    {
        $accessCheck = $this->checkMainAdminAccess();
        if ($accessCheck) return $accessCheck;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',
            'package_id' => 'nullable|exists:packages,id',
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with([
                'error' => 'Failed to create admin. Please check the input fields.'
            ]);
        }

        $data = $request->all();
        
        // Set admin_id to 1 for all admin users
        $data['admin_id'] = 1;
        
        // Set default password
        $data['password'] = Hash::make('12345678');
        
        // Handle profile image upload
        if ($request->hasFile('profile_img')) {
            $profileImg = $request->file('profile_img');
            $filename = time() . '_' . $profileImg->getClientOriginalName();
            $profileImg->move(public_path('admin_profile'), $filename);
            $data['profile_img'] = $filename;
        }

        // Handle banner image upload
        if ($request->hasFile('banner_img')) {
            $bannerImg = $request->file('banner_img');
            $filename = time() . '_' . $bannerImg->getClientOriginalName();
            $bannerImg->move(public_path('admin_banner'), $filename);
            $data['banner_img'] = $filename;
        }

        $admin = User::create($data);

        // Send welcome email
        try {
            $this->sendWelcomeEmail($admin);
            Log::info('Welcome email sent successfully to: ' . $admin->email);
        } catch (\Exception $e) {
            // Log the error but don't fail the admin creation
            Log::error('Failed to send welcome email to admin: ' . $e->getMessage());
            Log::error('Email error details: ' . $e->getTraceAsString());
        }

        return redirect()->route('admins.index')->with([
            'success' => 'Admin created successfully! Welcome email sent.'
        ]);
    }

    public function show(User $admin)
    {
        $accessCheck = $this->checkMainAdminAccess();
        if ($accessCheck) return $accessCheck;

        // Ensure this is an admin user
        if ($admin->admin_id != 1) {
            abort(404);
        }
        
        return view('admin.admins.show', compact('admin'));
    }

    public function edit(User $admin)
    {
        $accessCheck = $this->checkMainAdminAccess();
        if ($accessCheck) return $accessCheck;

        // Ensure this is an admin user
        if ($admin->admin_id != 1) {
            abort(404);
        }
        
        $packages = Package::where('status', true)->get();
        return view('admin.admins.edit', compact('admin', 'packages'));
    }

    public function update(Request $request, User $admin)
    {
        $accessCheck = $this->checkMainAdminAccess();
        if ($accessCheck) return $accessCheck;

        // Ensure this is an admin user
        if ($admin->admin_id != 1) {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $admin->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',
            'package_id' => 'nullable|exists:packages,id',
            'password' => 'nullable|string|min:8|confirmed',
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with([
                'error' => 'Failed to update admin. Please check the input fields.'
            ]);
        }

        $data = $request->all();

        // Handle password update
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            // Remove password from data if not provided
            unset($data['password']);
        }

        // Handle profile image upload
        if ($request->hasFile('profile_img')) {
            // Delete old profile image
            if ($admin->profile_img) {
                $oldProfilePath = public_path('admin_profile/' . $admin->profile_img);
                if (File::exists($oldProfilePath)) {
                    File::delete($oldProfilePath);
                }
            }
            
            $profileImg = $request->file('profile_img');
            $filename = time() . '_' . $profileImg->getClientOriginalName();
            $profileImg->move(public_path('admin_profile'), $filename);
            $data['profile_img'] = $filename;
        }

        // Handle banner image upload
        if ($request->hasFile('banner_img')) {
            // Delete old banner image
            if ($admin->banner_img) {
                $oldBannerPath = public_path('admin_banner/' . $admin->banner_img);
                if (File::exists($oldBannerPath)) {
                    File::delete($oldBannerPath);
                }
            }
            
            $bannerImg = $request->file('banner_img');
            $filename = time() . '_' . $bannerImg->getClientOriginalName();
            $bannerImg->move(public_path('admin_banner'), $filename);
            $data['banner_img'] = $filename;
        }

        $admin->update($data);

        $message = 'Admin updated successfully!';
        if ($request->filled('password')) {
            $message .= ' Password has been updated.';
        }

        return redirect()->route('admins.index')->with([
            'success' => $message
        ]);
    }

    public function destroy(User $admin)
    {
        $accessCheck = $this->checkMainAdminAccess();
        if ($accessCheck) return $accessCheck;

        // Ensure this is an admin user
        if ($admin->admin_id != 1) {
            abort(404);
        }

        try {
            // Delete profile image
            if ($admin->profile_img) {
                $profilePath = public_path('admin_profile/' . $admin->profile_img);
                if (File::exists($profilePath)) {
                    File::delete($profilePath);
                }
            }

            // Delete banner image
            if ($admin->banner_img) {
                $bannerPath = public_path('admin_banner/' . $admin->banner_img);
                if (File::exists($bannerPath)) {
                    File::delete($bannerPath);
                }
            }

            $admin->delete();
            return response()->json(['success' => 'Admin deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete the admin.'], 500);
        }
    }

    public function resetPassword(User $admin)
    {
        $accessCheck = $this->checkMainAdminAccess();
        if ($accessCheck) return $accessCheck;

        // Ensure this is an admin user
        if ($admin->admin_id != 1) {
            abort(404);
        }

        try {
            // Reset password to default
            $admin->update(['password' => Hash::make('12345678')]);
            
            // Send password reset email
            try {
                $this->sendPasswordResetEmail($admin);
                Log::info('Password reset email sent successfully to: ' . $admin->email);
            } catch (\Exception $e) {
                Log::error('Failed to send password reset email to admin: ' . $e->getMessage());
                Log::error('Email error details: ' . $e->getTraceAsString());
            }
            
            return response()->json(['success' => 'Password reset successfully! Email sent.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to reset password.'], 500);
        }
    }

    private function sendWelcomeEmail($admin)
    {
        $data = [
            'name' => $admin->name,
            'email' => $admin->email,
            'password' => '12345678',
            'login_url' => url('/login'),
        ];

        Mail::send('emails.admin-welcome', $data, function ($message) use ($admin) {
            $message->to($admin->email, $admin->name)
                    ->subject('Welcome to Admin Panel - Your Account Details');
        });
    }

    private function sendPasswordResetEmail($admin)
    {
        $data = [
            'name' => $admin->name,
            'email' => $admin->email,
            'password' => '12345678',
            'login_url' => url('/login'),
        ];

        Mail::send('emails.admin-password-reset', $data, function ($message) use ($admin) {
            $message->to($admin->email, $admin->name)
                    ->subject('Password Reset - Admin Panel');
        });
    }
}
