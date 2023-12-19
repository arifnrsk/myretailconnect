<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Courier;


class CourierController extends Controller
{
    //
    public function index () 
    {
        $couriers = Courier::all();
    
        return view('profile_courier', compact('couriers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'birth_date' => 'required|date',
            'address' => 'required',
            'phone_number' => 'required'
        ]);

        // Membuat data kurir baru
        $courier = new Courier;
        $courier->name = $validatedData['name'];
        $courier->birth_date = $validatedData['birth_date'];
        $courier->address = $validatedData['address'];
        $courier->phone_number = $validatedData['phone_number'];
        $courier->save();

        // Mengembalikan pengguna ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Courier added successfully.');
    }

    public function deleteCourier($courierId)
    {
        $courier = Courier::findorFail($courierId);
        $courier->delete();

        return response()->json(['success' => 'Courier deleted successfully.']);
        
    }

}
