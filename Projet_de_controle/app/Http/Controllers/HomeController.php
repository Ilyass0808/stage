<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Get 2 random products for the hero section
        $heroProducts = Product::inRandomOrder()->take(2)->get();
        
        $products = Product::latest()->take(8)->get();
        $categories = Category::withCount('products')->take(6)->get();
        
        return view('client.home', compact('products', 'categories', 'heroProducts'));
    }
}
