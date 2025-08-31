<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'profile_img' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Handle profile image upload
        if ($request->hasFile('profile_img')) {
            // Delete old image if exists
            if ($user->profile_img && file_exists(public_path('admin_profile/' . $user->profile_img))) {
                unlink(public_path('admin_profile/' . $user->profile_img));
            }

            // Store new image in public/admin_profile folder
            $image = $request->file('profile_img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            // Create directory if it doesn't exist
            if (!file_exists(public_path('admin_profile'))) {
                mkdir(public_path('admin_profile'), 0755, true);
            }
            
            // Move image to public/admin_profile folder
            $image->move(public_path('admin_profile'), $imageName);
            $data['profile_img'] = $imageName;
        }

        $user->update($data);

        return redirect()->route('admin.profile.edit')->with('success', 'Profile updated successfully!');
    }
}
