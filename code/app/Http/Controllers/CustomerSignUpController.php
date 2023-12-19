<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;

class CustomerSignUpController extends Controller
{
    //
    public function showSignupForm()
    {
        return view('customer.customer_signup');
    }

    public function signup(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone_number' => [
                'required',
                'regex:/^\+\d{2}\s\d{3}-\d{4}-\d{4}$/'
            ],
            'gender' => 'required|in:male,female',
            'password' => [
                'required',
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
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'address' => $request->address,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'password' => bcrypt($request->password),
            'profile_picture_path' => 'customer default profile picture.png',
        ]);

        // Logika opsional: langsung masuk setelah mendaftar
        Auth::guard('customer')->login($customer);

        return redirect('customer/home')->with('success', 'Account created successfully and logged in.');

    }
}
