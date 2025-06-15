<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\SalesOrder;



class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalSales = $totalOrders = $lowStockCount = 0;
        $mySales = $myOrders = 0;

        if ($user->hasRole('admin')) {
            $totalSales = SalesOrder::sum('total_amount');
            $totalOrders = SalesOrder::count();
            $lowStockCount = Product::where('quantity', '<', 5)->count();
        } elseif ($user->hasRole('salesperson')) {
            $mySales = $user->salesOrders()->sum('total_amount');
            $myOrders = $user->salesOrders()->count();
        }

      return view('dashboard', compact('totalSales', 'totalOrders', 'lowStockCount', 'mySales', 'myOrders'));
 
    }
     
}
