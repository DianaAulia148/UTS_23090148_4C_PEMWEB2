<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // Menampilkan daftar semua orders
    public function index()
    {
        $orders = Order::with('customer')->latest()->get();
        return view('dashboard.orders.index', compact('orders'));
    }

    // Menampilkan detail dari satu order
    public function show(Order $order)
    {
        // Pastikan eager load relasi customer dan orderDetails
        $order->load(['customer', 'orderDetails.product']);
        return view('dashboard.orders.show', compact('order'));
    }
}
