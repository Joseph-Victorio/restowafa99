<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $month = Carbon::today();
        $year = Carbon::today();

        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $cookedOrders = Order::where('status', 'cooked')->count();
        $todayOrders = Order::whereDate('created_at', $today)->count();

        $todayRevenue = Order::whereDate('created_at', $today)->where('status_pembayaran', 'sudah_dibayar')->sum('total_harga');
        $monthRevenue = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->where('status_pembayaran', 'sudah_dibayar')
            ->sum('total_harga');

        $yearRevenue = Order::whereYear('created_at', now()->year)
            ->where('status_pembayaran', 'sudah_dibayar')
            ->sum('total_harga');


        $recentOrders = Order::with('items')
            ->latest()
            ->take(5)
            ->get();

        $start = now()->startOfMonth();
        $end = now()->endOfMonth();

        $days = [];
        $revenues = [];

        $period = Carbon::parse($start)->daysUntil($end->copy()->addDay());

        foreach ($period as $date) {
            $days[] = $date->format('d M');

            $revenues[] = Order::whereDate('created_at', $date)->where('status_pembayaran', 'sudah_dibayar')
                ->sum('total_harga');
        }


        return view('dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'cookedOrders',
            'todayOrders',
            'todayRevenue',
            'monthRevenue',
            'yearRevenue',
            'recentOrders',
            'days',
            'revenues',
        ));
    }

    public function getRevenue(Request $request)
    {
        $month = $request->month ?? now()->month;
        $year = $request->year ?? now()->year;

        $start = Carbon::create($year, $month, 1)->startOfMonth();
        $end = $start->copy()->endOfMonth();

        $days = [];
        $revenues = [];

        $period = Carbon::parse($start)->daysUntil($end->copy()->addDay());

        foreach ($period as $date) {
            $days[] = $date->format('d M');

            $revenues[] = Order::whereDate('created_at', $date)
                ->where('status_pembayaran', 'sudah_dibayar')
                ->sum('total_harga');
        }

        return response()->json([
            'days' => $days,
            'revenues' => $revenues
        ]);
    }



    public function downloadLaporan(Request $request)
    {
        $year = $request->year ?? now()->year;


        $months = [];
        $revenues = [];

        for ($m = 1; $m <= 12; $m++) {
            $months[] = Carbon::createFromDate($year, $m, 1)->format('F');

            $revenues[] = Order::whereYear('created_at', $year)
                ->whereMonth('created_at', $m)
                ->where('status_pembayaran', 'sudah_dibayar')
                ->sum('total_harga');
        }


        $totalYearRevenue = array_sum($revenues);

        $pdf = Pdf::loadView('laporan.revenue', [
            'year' => $year,
            'months' => $months,
            'revenues' => $revenues,
            'totalYearRevenue' => $totalYearRevenue
        ])->setPaper('A4', 'portrait');

        return $pdf->download("Laporan_Pendapatan_{$year}.pdf");
    }
    public function downloadLaporanBulanan(Request $request)
    {
        $month = intval($request->month ?? now()->month);

        $year = $request->year ?? now()->year;

        $start = Carbon::create($year, $month, 1)->startOfMonth();
        $end = Carbon::create($year, $month, 1)->endOfMonth();

        $days = [];
        $revenues = [];

        $period = Carbon::parse($start)->daysUntil($end->copy()->addDay());

        foreach ($period as $date) {
            $days[] = $date->format('d M Y');
            $revenues[] = Order::whereDate('created_at', $date)
                ->where('status_pembayaran', 'sudah_dibayar')
                ->sum('total_harga');
        }

        $totalMonthlyRevenue = array_sum($revenues);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('laporan.bulanan', [
            'month' => $month,
            'year' => $year,
            'days' => $days,
            'revenues' => $revenues,
            'totalMonthlyRevenue' => $totalMonthlyRevenue,
        ])->setPaper('A4', 'portrait');
        return $pdf->download("Laporan_Pendapatan_{$month}_{$year}.pdf");
    }
}
