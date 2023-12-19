<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class ListProductController extends Controller
{
    public function index(Request $request) 
    {
        $selectedCategory = $request->query('category', '');
        $sortOrder = $request->query('sort', 'asc'); // 'asc' atau 'desc'
        $searchTerm = $request->query('search', ''); // Menangkap query pencarian

        $query = Product::with('images');
        
        if ($selectedCategory) {
            $query = $query->where('category_id', $selectedCategory);
        }

        if ($searchTerm) {
            // Menambahkan logika untuk pencarian tidak case sensitive
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
        }

        // Menambahkan logika untuk pengurutan
        $query = $query->orderBy('price', $sortOrder);

        $products = $query->get();
        $categories = Category::all();

        return view('list_product', compact('products', 'categories', 'selectedCategory', 'sortOrder', 'searchTerm'));
    }

    public function indexCustomer(Request $request) 
    {
        $selectedCategory = $request->query('category', '');
        $sortOrder = $request->query('sort', 'asc'); // 'asc' atau 'desc'
        $searchTerm = $request->query('search', ''); // Menangkap query pencarian

        $query = Product::with('images');
        
        if ($selectedCategory) {
            $query = $query->where('category_id', $selectedCategory);
        }

        if ($searchTerm) {
            // Menambahkan logika untuk pencarian tidak case sensitive
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
        }

        // Menambahkan logika untuk pengurutan
        $query = $query->orderBy('price', $sortOrder);

        $products = $query->get();
        $categories = Category::all();

        return view('customer.customer_homepage', compact('products', 'categories', 'selectedCategory', 'sortOrder', 'searchTerm'));
    }
}
