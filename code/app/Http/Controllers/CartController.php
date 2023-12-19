<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\DeliveryType;
use App\Models\Delivery;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {

        $customerId = Auth::guard('customer')->id();

        // Mendapatkan kuantitas dari request
        $quantity = $request->input('quantity', 1); // Default ke 1 jika tidak ada input

        // Cek jika produk sudah ada di keranjang
        $cartItem = CartItem::where('customer_id', $customerId)
                            ->where('product_id', $productId)
                            ->first();

        if ($cartItem) {
            // Tambahkan kuantitas yang diminta ke kuantitas yang sudah ada
            $cartItem->increment('quantity', $quantity);
        } else {
            // Tambah produk baru ke keranjang dengan kuantitas yang diminta
            CartItem::create([
                'customer_id' => $customerId,
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }

        // Redirect atau return response
        return back()->with('success', 'Product added to cart successfully!');
    }

    public function showCart()
    {
        $customerId = Auth::guard('customer')->id();

        $cartItems = CartItem::with(['product', 'product.images', 'customer'])
                            ->where('customer_id', $customerId)
                            ->get();

        $customerInfo = $cartItems->first() ? $cartItems->first()->customer : null;
        $deliveryTypeInfo = DeliveryType::all();

        return view('customer.customer_cart', compact('cartItems', 'customerInfo', 'deliveryTypeInfo'));
    }

    public function updateQuantity(Request $request)
    {
        $customerId = Auth::guard('customer')->id();

        $cartItemId = $request->input('cart_item_id');
        $quantity = $request->input('quantity');

        $cartItem = CartItem::where('customer_id', $customerId)
                            ->where('id', $cartItemId)
                            ->first();

        if ($cartItem && $quantity > 0) {
            $cartItem->update(['quantity' => $quantity]);
            return response()->json(['success' => true, 'message' => 'Quantity updated.']);
        }

        return response()->json(['success' => false, 'message' => 'Failed to update quantity.']);
    }

    public function deleteFromCart($id)
    {
        $item = CartItem::find($id);

        if ($item) {
            $item->delete();
            return response()->json(['success' => true, 'message' => 'Item removed from cart.']);
        }

        return response()->json(['success' => false, 'message' => 'Item not found in cart.']);
    }

    public function checkout(Request $request)
    {
        Log::info('Checkout method called', ['request' => $request->all()]);

        $customerId = Auth::guard('customer')->id();


        // Mulai transaksi database
        DB::beginTransaction();
        try {
            // Buat objek delivery baru
            $delivery = new Delivery([
                'courier_id' => 1, // Default courier_id
                'delivery_date' => now()->addHour(), // Tambahkan 1 jam dari waktu saat ini
                'delivery_status_id' => 1, // Status 'Pending'
                'delivery_type_id' => $request->input('delivery_type'), // Ambil dari input form
                'delivery_price' => $request->input('delivery_price'), // Ambil dari input form
            ]);
            $delivery->save();
            Log::info('Delivery data', ['delivery' => $delivery->toArray()]);

            // Buat objek transaksi baru
            $transaction = new Transaction([
                'customer_id' => $customerId,
                'transaction_date' => now(),
                'transaction_status_id' => 1, // Set default status, misalkan 1 untuk 'Pending'
                'total_amount' => 0, // Akan di-update nanti
                'delivery_id' => $delivery->id, // ID dari delivery yang baru dibuat
                'payment_id' => 1, // Set default payment_id, misalkan 1 untuk 'Bank Transfer'
            ]);
            $transaction->save();
            Log::info('Transaction data', ['transaction' => $transaction->toArray()]);

            // Hitung dan simpan total amount
            $totalAmount = 0;

            // Ambil item dari keranjang milik customer
            $cartItems = CartItem::where('customer_id', $customerId)->get();
            foreach ($cartItems as $cartItem) {
                $totalAmount += $cartItem->product->price * $cartItem->quantity;

                // Kurangi stok produk
                $product = $cartItem->product;
                $product->stock -= $cartItem->quantity; // Mengurangi stok
                $product->save();

                // Buat detail transaksi untuk setiap item
                $transactionDetail = new TransactionDetail([
                    'transaction_id' => $transaction->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                ]);
                $transactionDetail->save();
                Log::info('TransactionDetail saved', ['transactionDetail' => $transactionDetail->toArray()]);

                // Hapus item dari keranjang
                $cartItem->delete();
            }

            // Tambahkan delivery price ke total amount
            $totalAmount += $request->input('delivery_price');

            // Update total amount transaksi
            $transaction->total_amount = $totalAmount;
            $transaction->save();

            // Buat objek Invoice baru
            $invoice = new Invoice([
                'customer_id' => $customerId,
                'delivery_id' => $delivery->id,
                'invoice_date' => now(),
                'transaction_id' => $transaction->id
            ]);
            $invoice->save();
            Log::info('Invoice data', ['invoice' => $invoice->toArray()]);

            // Commit transaksi database
            DB::commit();
            Log::info('Transaction committed');

            // Redirect dengan pesan sukses
            return redirect()->route('customer.home.show')->with('success', 'Checkout successful!');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();
            Log::error('Checkout failed', ['error' => $e->getMessage()]);
            // Redirect dengan pesan error
            return back()->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }

}