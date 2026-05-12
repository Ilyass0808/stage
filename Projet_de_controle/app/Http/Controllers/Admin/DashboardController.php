<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = \App\Models\Product::count();
        $totalOrders = \App\Models\Order::count();
        $totalClients = \App\Models\User::where('role', 'client')->count();
        $revenue = \App\Models\Order::where('status', '!=', 'en attente')->sum('total');

        return view('admin.dashboard', compact('totalProducts', 'totalOrders', 'totalClients', 'revenue'));
    }
}
