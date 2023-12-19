<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    
    public function index(Request $request)
    {
        $searchTerm = $request->query('search', '');
        $sortOrder = $request->query('sort', 'desc'); // 'desc' sebagai default

        $query = Review::with('product', 'customer');

        if ($searchTerm) {
            // Pencarian berdasarkan nama customer
            $query->whereHas('customer', function($query) use ($searchTerm) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
            });
        }

        // Pengurutan berdasarkan tanggal review
        $query = $query->orderBy('review_date', $sortOrder);

        $reviews = $query->get();

        return view('review_product', compact('reviews', 'sortOrder', 'searchTerm'));
    }

    public function store(Request $request)
    {
        $customerId = Auth::guard('customer')->id();
        $productIds = $request->input('product_ids');
        $ratings = $request->input('ratings');
        $comments = $request->input('comments');
    
        foreach ($productIds as $index => $productId) {
            $review = new Review();
            $review->customer_id = $customerId;
            $review->product_id = $productId;
            $review->ratings = $ratings[$index];
            $review->comment = $comments[$index] ?? 'No comment from this user';
            $review->review_date = now();
            $review->save();
        }
    
        return response()->json(['message' => 'Reviews successfully submitted']);
    }    
}
