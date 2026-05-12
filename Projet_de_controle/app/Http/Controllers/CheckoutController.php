<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Votre panier est vide.');
        }
        $total = array_reduce($cart, fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0);
        return view('client.checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Panier vide.');
        }

        $request->validate([
            'email' => 'required|email',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string',
            'payment_method' => 'required|in:especes,carte',
        ]);

        $total = 0;
        foreach ($cart as $id => $item) {
            $product = \App\Models\Product::find($id);
            if (!$product || $product->stock < $item['quantity']) {
                return back()->with('error', "Le produit {$item['name']} n'a pas assez de stock.");
            }
            $total += $item['price'] * $item['quantity'];
        }

        DB::transaction(function () use ($cart, $total, $request) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'total' => $total,
                'status' => 'en attente',
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'payment_method' => $request->payment_method,
            ]);

            foreach ($cart as $id => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity']
                ]);

                Product::where('id', $id)->decrement('stock', $item['quantity']);
            }
        });

        session()->forget('cart');
        return redirect()->route('orders.index')->with('success', 'Commande validée avec succès !');
    }
}
