<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    public function index()
{
    $orders = \App\Models\Order::with('items')->orderByDesc('created_at')->get();
    return view('orders.index', compact('orders'));
}

public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,cooked,paid,cancelled'
    ]);

    $order = \App\Models\Order::findOrFail($id);
    $order->status = $request->status;
    $order->save();

    return redirect()->route('orders.index')->with('success', 'Status berhasil diperbarui!');
}

    public function checkout(Request $request)
    {
        $data = $request->validate([
            'meja_id' => 'required',
            'cart' => 'required|array',
            'cart.*.id' => 'required|integer',
            'cart.*.nama' => 'required|string',
            'cart.*.harga' => 'required|integer',
            'cart.*.qty' => 'required|integer',
        ]);

        $cart = $data['cart'];
        $total = collect($cart)->sum(fn($i) => $i['harga'] * $i['qty']);

        DB::beginTransaction();
        try {
            $order = Order::create([
                'meja_id' => $data['meja_id'],
                'total_harga' => $total,
                'status' => 'pending',
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'nama_menu' => $item['nama'],
                    'qty' => $item['qty'],
                    'harga' => $item['harga'],
                ]);
            }

            DB::commit();

        
            Config::$serverKey = config('services.midtrans.server_key');
            Config::$isProduction = false; 
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $order->id,
                    'gross_amount' => $total,
                ],
                'customer_details' => [
                    'first_name' => 'Meja ' . $data['meja_id'],
                    'email' => 'meja' . $data['meja_id'] . '@restowafa.local',
                ],
            ];

            $snapToken = Snap::getSnapToken($params);

            return response()->json([
                'success' => true,
                'snapToken' => $snapToken,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.serverKey');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed === $request->signature_key) {
            $order = Order::find($request->order_id);
            if ($order) {
                if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                    $order->update(['status' => 'paid']);
                } elseif ($request->transaction_status == 'cancel') {
                    $order->update(['status' => 'cancelled']);
                }
            }
        }
        return response()->json(['status' => 'ok']);
    }
    public function riwayat(Request $request)
{
    $meja_id = session('meja_id') ?? $request->query('meja_id');

    $orders = Order::with('items')
        ->where('meja_id', $meja_id)
        ->latest()
        ->first();

    return view('riwayat', compact('orders', 'meja_id'));
}

}
