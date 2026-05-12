<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RevenueController extends Controller
{
    public function index()
    {
        // Total Revenue (all completed or shipped orders)
        $totalRevenue = Order::whereIn('status', ['expédiée', 'livrée'])->sum('total');
        
        // Revenue per month (Last 6 months)
        $monthlyRevenue = Order::whereIn('status', ['expédiée', 'livrée'])
            ->select(
                DB::raw('SUM(total) as total'),
                DB::raw("strftime('%m %Y', created_at) as month"),
                DB::raw("strftime('%m', created_at) as month_num")
            )
            ->groupBy('month', 'month_num')
            ->orderBy('month_num', 'desc')
            ->take(6)
            ->get();

        // Total Withdrawals (Completed + Pending to deduct immediately)
        $totalWithdrawn = Withdrawal::whereIn('status', ['en attente', 'complété'])->sum('amount');
        
        // Current Balance
        $balance = $totalRevenue - $totalWithdrawn;

        // Transactions History (Orders)
        $recentOrders = Order::whereIn('status', ['expédiée', 'livrée'])
            ->latest()
            ->take(10)
            ->get();

        // Withdrawals History
        $withdrawals = Withdrawal::latest()->take(10)->get();

        return view('admin.revenue.index', compact(
            'totalRevenue', 
            'monthlyRevenue', 
            'balance', 
            'recentOrders', 
            'withdrawals',
            'totalWithdrawn'
        ));
    }

    public function storeWithdrawal(Request $request)
    {
        $totalRevenue = Order::whereIn('status', ['expédiée', 'livrée'])->sum('total');
        $totalWithdrawn = Withdrawal::whereIn('status', ['en attente', 'complété'])->sum('amount');
        $balance = $totalRevenue - $totalWithdrawn;

        $request->validate([
            'amount' => 'required|numeric|min:100|max:' . $balance,
            'method' => 'required|in:paypal,card',
            'account_details' => 'required|string'
        ]);

        Withdrawal::create([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'method' => $request->method,
            'account_details' => $request->account_details,
            'status' => 'en attente'
        ]);

        return back()->with('success', 'Votre demande de retrait a été envoyée avec succès.');
    }
}
