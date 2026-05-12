<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        
        DB::transaction(function() use ($request, $data) {
            $product = Product::create($data);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $file) {
                    $path = $file->store('products', 'public');
                    
                    // Set the first image as the main one in products table
                    if ($index === 0) {
                        $product->update(['image' => $path]);
                    }

                    $product->images()->create([
                        'image_path' => $path,
                        'position' => $index
                    ]);
                }
            }
        });

        return redirect()->route('admin.products.index')->with('success', 'Produit créé avec succès.');
    }

    public function edit(Product $product)
    {
        $product->load('images');
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        DB::transaction(function() use ($request, $data, $product) {
            $product->update($data);

            if ($request->hasFile('images')) {
                // For simplicity, we clear old images and add new ones
                // In a real app, you might want to manage specific ones
                foreach ($product->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage->image_path);
                    $oldImage->delete();
                }

                foreach ($request->file('images') as $index => $file) {
                    $path = $file->store('products', 'public');
                    
                    if ($index === 0) {
                        $product->update(['image' => $path]);
                    }

                    $product->images()->create([
                        'image_path' => $path,
                        'position' => $index
                    ]);
                }
            }
        });

        return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produit supprimé avec succès.');
    }
}
