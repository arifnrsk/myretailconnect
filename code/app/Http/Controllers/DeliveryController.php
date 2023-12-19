<?php

namespace App\Http\Controllers;
use App\Models\Courier;
use App\Models\DeliveryStatus;
use App\Models\Delivery;
use App\Models\DeliveryType;
use App\Models\RetailAddress;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DeliveryController extends Controller
{
    //
    public function index(Request $request)
    {
        $searchTerm = $request->query('search', '');

        $query = Delivery::with(['courier', 'deliveryStatus', 'deliveryType']);

        if ($searchTerm) {
            // Pencarian berdasarkan ID pengiriman
            $query->where('id', 'LIKE', "%{$searchTerm}%");
        }

        $deliveries = $query->get();
        $couriers = Courier::all();
        $deliveryStatuses = DeliveryStatus::all();

        return view('delivery', compact('deliveries', 'couriers', 'deliveryStatuses', 'searchTerm'));
    }

    public function delivery_types()
    {
        $types = DeliveryType::all();
        $currentAddress = RetailAddress::first()->address ?? 'Default address'; // Mengambil alamat pertama atau default

        return view('profile_delivery', compact('types', 'currentAddress'));
    }

    public function delete($id)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->delete();

        return response()->json(['success' => 'Delivery and related data deleted successfully.']);
    }

    public function updateRetailAddress(Request $request)
    {
        $validatedData = $request->validate([
            'address' => 'required|max:255',
        ]);
    
        Log::info('UpdateRetailAddress - Validated Data', $validatedData);
    
        // Coba ambil alamat retail pertama, jika tidak ada, buat baru
        $retailAddress = RetailAddress::first();
    
        if ($retailAddress) {
            // Jika ada, perbarui alamat
            $retailAddress->update(['address' => $validatedData['address']]);
            Log::info('Retail address updated', ['new_address' => $retailAddress->address]);
        } else {
            // Jika tidak ada, buat record baru
            $retailAddress = RetailAddress::create(['address' => $validatedData['address']]);
            Log::info('New retail address created', ['new_address' => $retailAddress->address]);
        }
    
        return response()->json(['success' => true, 'message' => 'Address updated successfully']);
    }    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric'
        ]);

        DeliveryType::create([
            'name' => $validatedData['name'],
            'price' => $validatedData['price']
        ]);

        return redirect()->back()->with('success', 'Delivery type added successfully.');
    }

    public function deleteDeliveryType($id)
    {
        $deliveryType = DeliveryType::findOrFail($id);
        $deliveryType->delete();

        return response()->json(['success' => 'Delivery type deleted successfully.']);
    }

    public function updateCourier($deliveryId, Request $request)
    {
        $delivery = Delivery::findOrFail($deliveryId);
        $delivery->courier_id = $request->courier_id;
        $delivery->save();

        return response()->json(['success' => true]);
    }

    public function updateStatus($deliveryId, Request $request)
    {
        $delivery = Delivery::findOrFail($deliveryId);
        $delivery->delivery_status_id = $request->status_id;
        $delivery->save();

        return response()->json(['success' => true]);
    }

}
