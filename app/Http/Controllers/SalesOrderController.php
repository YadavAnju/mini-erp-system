<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use Illuminate\Support\Str;
use App\Http\Requests\StoreSalesOrderRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class SalesOrderController extends Controller
{

    public function index()
    {
        $orders = auth()->user()->salesOrders()->latest()->get();
        return view('sales.orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::where('quantity', '>', 0)->get();
        return view('sales.orders.create', compact('products'));
    }

    public function store(StoreSalesOrderRequest $request)
    {
        $user = auth()->user();
        if (!$user) {
            return back()->withErrors(['message' => 'Authentication required.']);
        }
        $totalAmount = 0;

        // Filter product quantity 0
        $selectedProducts = collect($request->products)->filter(function ($item) {
                return isset($item['quantity']) && (int)$item['quantity'] > 0;
            });

        if ($selectedProducts->isEmpty()) {
            return back()->withErrors(['message' => 'Please select at least one product with a quantity greater than zero.']);
        }

        try {
       
        $productsToOrder = [];

        foreach ($selectedProducts as $item) {
            $product = Product::findOrFail($item['product_id']);

            $requestedQuantity = (int) $item['quantity'];
            if ($product->quantity < $requestedQuantity) {
                return back()->withErrors(['Stock for ' . $product->name . ' is not sufficient.']);
            }

            $productsToOrder[] = [
                    'product'           => $product,
                    'requested_quantity' => $requestedQuantity,
                    'line_total'        => $product->price * $requestedQuantity,
            ];

            $totalAmount += ($product->price * $requestedQuantity);
        }
         //sales order create
         $order = SalesOrder::create([
                'order_number' => 'SO-' . strtoupper(Str::random(6)),
                'user_id'      => $user->id,
                'total_amount' => $totalAmount, 
                'status'       => 'confirmed', 
         ]);

          foreach ($productsToOrder as $itemData) {
                $product = $itemData['product'];
                $requestedQuantity = $itemData['requested_quantity'];
                $lineTotal = $itemData['line_total'];

                SalesOrderItem::create([
                    'sales_order_id' => $order->id,
                    'product_id'     => $product->id,
                    'quantity'       => $requestedQuantity,
                    'price'          => $product->price,
                    'line_total'     => $lineTotal,
                ]);

                // Decrement stock
                $product->decrement('quantity', $requestedQuantity);
            }

        return redirect()->route('sales.orders.create')->with('success', 'Order created successfully.');
       }catch (\Exception $e) {
             DB::rollBack(); 
            \Log::error("Sales Order creation failed: " . $e->getMessage(), ['exception' => $e]);
            return back()->withErrors(['message' => 'Failed to create sales order due to an unexpected error.']);
        }
    }

     public function show(SalesOrder $order)
    {
        $order->load('items.product');
        return view('sales.orders.show', compact('order'));
    }

    public function downloadPDF(SalesOrder $order)
    {
     $order->load('items.product');

    $pdf = Pdf::loadView('sales.orders.invoice', compact('order'));
    return $pdf->download('invoice_' . $order->order_number . '.pdf');
   }


}
