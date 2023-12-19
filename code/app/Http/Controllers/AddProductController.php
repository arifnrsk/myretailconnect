<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;

class AddProductController extends Controller
{
    //
    public function index ()
    {
        $units = Unit::all();
        $categories = Category::all();

        return view('add_product', compact('units', 'categories'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'unit_id' => 'required|exists:units,id',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id,
            'stock' => $request->stock
        ]);        

        if($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Menyimpan file di folder 'products' dan mendapatkan path lengkap
                $fullPath = $image->store('products', 'public');
    
                // Mendapatkan hanya nama file dari path lengkap
                $fileName = basename($fullPath);
    
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $fileName // Menyimpan hanya nama file
                ]);
            }
        }

        return redirect()->route('list.products.show')->with('success', 'Product added successfully');
    }

}
