<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Unit;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductDetailController extends Controller
{
    //
    public function show($id)
    {
        $product = Product::with(['images', 'reviews.customer'])->findOrFail($id);

        return view('product_detail', compact('product'));
    }

    public function customerShow($id)
    {
        $product = Product::with(['images', 'reviews.customer'])->findOrFail($id);

        return view('customer.customer_product_detail', compact('product'));
    }

    public function showEdit($id)
    {
        $product = Product::with(['images', 'unit', 'category'])->findOrFail($id);
        $units = Unit::all();
        $categories = Category::all();

        return view('edit_product', compact('product', 'units', 'categories'));
    }

    public function deleteImage($id)
    {
        $image = ProductImage::findOrFail($id);
        // Hapus file dari storage
        Storage::delete('storage/products/' . $image->image_path);
        // Hapus dari database
        $image->delete();

        return response()->json(['message' => 'Image deleted successfully']);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'unit_id' => 'required|exists:units,id',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product->update($request->only(['name', 'description', 'price', 'unit_id', 'category_id', 'stock']));

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

        return redirect()->route('list.products.show')->with('success', 'Product updated successfully');
    }

    public function delete($id)
    {
        $product = Product::with('images')->findOrFail($id);

        // Delete associated images
        foreach ($product->images as $image) {
            Storage::delete('storage/products/' . $image->image_path);
            $image->delete();
        }

        // Delete the product itself
        $product->delete();

        return redirect()->route('list.products.show')->with('success', 'Product deleted successfully');
    }

}
