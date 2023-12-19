<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Models\PaymentBank;
use App\Models\BankName;


class PaymentController extends Controller
{
    //
    public function index()
    {
        $bankNames = BankName::all(); // Mengambil semua nama bank
        $banks = PaymentBank::with('bankName')->get();

        return view('profile_payment', compact('bankNames', 'banks'));
    }

    public function addPaymentInfo(Request $request)
    {
        $validatedData = $request->validate([
            'account_name' => 'required|max:255',
            'account_number' => [
                'required',
                'numeric',
                Rule::unique('payment_banks', 'account_number')
            ],
            'bank_name' => 'required',
        ]);

        Log::info('Validated data', $validatedData);

        $existingAccount = PaymentBank::where('account_number', $validatedData['account_number'])->first();
        if (!$existingAccount) {
            PaymentBank::create([
                'payment_id' => 1, // Menggunakan nilai default 1
                'account_name' => $validatedData['account_name'],
                'account_number' => $validatedData['account_number'],
                'bank_name_id' => $validatedData['bank_name'], // Gunakan 'bank_name_id' dari input form
            ]);

            return redirect()->back()->with('success', 'Bank information added successfully');
        }

        return redirect()->back()->with('error', 'Account number already exists');
    }

    public function deleteBank($id)
    {
        $paymentBank = PaymentBank::findOrFail($id);
        $paymentBank->delete();

        return response()->json(['success' => true]);
    }

}
