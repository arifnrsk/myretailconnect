<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;
use App\Models\Review;

class InvoiceController extends Controller
{
    //
    public function show($id)
    {
        $invoice = Invoice::with(['customer', 'delivery', 'transaction.transactionDetails.product'])
            ->findOrFail($id);

        return view('invoice', compact('invoice'));
    }

    public function customerInvoiceShow($id)
    {
        $customerId = Auth::guard('customer')->id();
        $invoice = Invoice::with(['customer', 'delivery', 'transaction.transactionDetails.product'])
                        ->findOrFail($id);

        $canReview = true; // Asumsi default bahwa customer dapat memberikan review

        foreach ($invoice->transaction->transactionDetails as $detail) {
            $product_id = $detail->product_id;
            $reviewExists = Review::where('customer_id', $customerId)
                                ->where('product_id', $product_id)
                                ->exists();
            if ($reviewExists) {
                $canReview = false; // Jika customer sudah memberikan review, set canReview menjadi false
                break; // Tidak perlu memeriksa produk lain
            }
        }

        return view('customer.customer_invoice', compact('invoice', 'canReview'));
    }
}
