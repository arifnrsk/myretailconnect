<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function profile()
    {
        
        // Mengambil admin yang sedang login
        $admin = Auth::guard('admin')->user();

        // Mengirimkan data admin ke view
        return view('profile', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        try {
            // Log request data
            Log::info('Admin update profile request:', $request->all());

            $admin = Admin::first();

            // Validasi input
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'password' => 'nullable|min:6',
            ]);

            // Hash password jika ada
            if (!empty($validatedData['password'])) {
                $validatedData['password'] = bcrypt($validatedData['password']);
            } else {
                unset($validatedData['password']);
            }

            // Update admin
            $admin->update($validatedData);

            // Log successful update
            Log::info('Admin profile updated successfully.', ['admin_id' => $admin->id]);

            return redirect()->back()->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            // Log error
            Log::error('Admin profile update failed.', ['error' => $e->getMessage()]);
            return back()->with('error', 'Failed to update profile: ' . $e->getMessage());
        }
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|max:2048', // 2MB Max
        ]);

        $admin = Admin::first();
        $file = $request->file('profile_picture');
        $filename = time() . '-' . $file->getClientOriginalName();

        // Simpan file di disk 'public', dalam folder 'admin'
        $fullPath = $file->storeAs('admin', $filename, 'public');

        // Mendapatkan hanya nama file dari path lengkap
        $fileName = basename($fullPath);

        // Update database dengan nama file
        $admin->profile_picture_path = $fileName;
        $admin->save();

        return back()->with('success', 'Profile picture updated successfully');
    }

}
