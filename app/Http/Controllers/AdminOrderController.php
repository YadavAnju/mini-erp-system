<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesOrder;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = SalesOrder::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(SalesOrder $order)
    {
        $order->load('user', 'items.product');
        return view('admin.orders.show', compact('order'));
    }
}
