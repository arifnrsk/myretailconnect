<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    //
    public function profile()
    {

        // Mengambil customer yang sedang login
        $customer = Auth::guard('customer')->user();

        // Mengirimkan data admin ke view
        return view('customer.customer_profile', compact('customer'));
    }

    public function updateProfile(Request $request)
    {
        
        try {
            // Log request data
            Log::info('Customer update profile request:', $request->all());

            // $customer = Customer::first();
            $customer = Auth::guard('customer')->user();

            // Validasi input
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'address' => 'required|max:255',
                'password' => [
                    'nullable',
                    'string',
                    'min:8',             // Minimal 8 karakter
                    'max:20',            // Maksimal 20 karakter
                    'regex:/[a-z]/',     // Setidaknya satu huruf kecil
                    'regex:/[A-Z]/',     // Setidaknya satu huruf besar
                    'regex:/[0-9]/',     // Setidaknya satu angka
                    'regex:/[@$!%*#?&]/', // Setidaknya satu karakter spesial
                    'not_regex:/\s/',    // Tidak boleh mengandung spasi
                    'not_regex:/\p{Lm}/', // Tidak boleh mengandung emoji
                ],
                'gender' => 'required|max:255',
                'phone_number' => 'required|min:12',
            ]);

            // Hash password jika ada
            if (!empty($validatedData['password'])) {
                $validatedData['password'] = bcrypt($validatedData['password']);
            } else {
                unset($validatedData['password']);
            }

            // Update admin
            $customer->update($validatedData);

            // Log successful update
            Log::info('Customer profile updated successfully.', ['customer_id' => $customer->id]);

            return redirect()->back()->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            // Log error
            Log::error('Customer profile update failed.', ['error' => $e->getMessage()]);
            return back()->with('error', 'Failed to update profile: ' . $e->getMessage());
        }
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|max:2048', // 2MB Max
        ]);

        // $customer = Customer::first();
        $customer = Auth::guard('customer')->user();

        $file = $request->file('profile_picture');
        $filename = time() . '-' . $file->getClientOriginalName();

        // Simpan file di disk 'public', dalam folder 'admin'
        $fullPath = $file->storeAs('customer', $filename, 'public');

        // Mendapatkan hanya nama file dari path lengkap
        $fileName = basename($fullPath);

        // Update database dengan nama file
        $customer->profile_picture_path = $fileName;
        $customer->save();

        return back()->with('success', 'Profile picture updated successfully');
    }
}
