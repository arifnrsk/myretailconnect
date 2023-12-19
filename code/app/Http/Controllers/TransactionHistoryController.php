<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionHistoryController extends Controller
{
    //
    public function index(Request $request)
    {
        $searchTerm = $request->query('search', '');

        $query = Transaction::with(['customer', 'transactionStatus', 'delivery', 'payment']);

        if ($searchTerm) {
            // Pencarian berdasarkan ID transaksi
            $query->where('id', 'LIKE', "%{$searchTerm}%");
        }

        $transactions = $query->orderBy('id', 'asc')->get();

        return view('transaction_history', compact('transactions', 'searchTerm'));
    }

    public function customer_transaction_history(Request $request)
    {
        // $customerId = 1; // ID customer dummy
        $customerId = Auth::guard('customer')->id();

        $searchTerm = $request->query('search', '');

        $query = Transaction::with(['customer', 'transactionStatus', 'delivery', 'payment'])
                    ->where('customer_id', $customerId);

        if ($searchTerm) {
            // Pencarian berdasarkan ID transaksi
            $query->where('id', 'LIKE', "%{$searchTerm}%");
        }

        $transactions = $query->orderBy('id', 'asc')->get();

        return view('customer.customer_transaction_history', compact('transactions', 'searchTerm'));
    }

}
