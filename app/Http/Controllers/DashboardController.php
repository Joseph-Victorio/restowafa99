<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $cookedOrders = Order::where('status', 'cooked')->count();
        $todayOrders = Order::whereDate('created_at', $today)->count();

        $todayRevenue = Order::whereDate('created_at', $today)->sum('total_harga');

        $recentOrders = Order::with('items')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'cookedOrders',
            'todayOrders',
            'todayRevenue',
            'recentOrders'
        ));
    }
}
