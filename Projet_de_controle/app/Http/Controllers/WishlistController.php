<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = auth()->user()->wishlists()->with('product')->get();
        return view('client.wishlist.index', compact('wishlists'));
    }

    public function add(Product $product)
    {
        $exists = auth()->user()->wishlists()->where('product_id', $product->id)->exists();
        if (!$exists) {
            auth()->user()->wishlists()->create(['product_id' => $product->id]);
        }
        return back()->with('success', 'Ajouté aux favoris.');
    }

    public function remove(Product $product)
    {
        auth()->user()->wishlists()->where('product_id', $product->id)->delete();
        return back()->with('success', 'Retiré des favoris.');
    }
}
