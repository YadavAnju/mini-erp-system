<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use Illuminate\Support\Str;
use App\Http\Requests\Api\StoreSalesOrderApiRequest;

class SalesOrderApiController extends Controller
{
      public function show($id)
    {
        try {
        $order = SalesOrder::with('items.product')->find($id);
        if (!$order) {
            return response()->json([
                'status'  => false,
                'message' => 'Sales order not found.',
                'data'    => null 
            ]); 
        }

        return response()->json([
            'status'  => true,
            'message' => 'Sales order retrieved successfully.',
            'order_number' => $order->order_number,
            'total' => $order->total_amount,
            'products' => $order->items->map(function ($item) {
                return [
                    'product_name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'line_total' => $item->line_total,
                ];
            })
        ]);

       }catch (\Exception $e) {
        return response()->json([
            'status'  => false,
            'message' => 'An internal server error occurred.',
        ]); 
        }
   
    }


    public function store(StoreSalesOrderApiRequest $request)
    {
        $user = auth()->user();
        $totalAmount = 0;
        try {
        $order = SalesOrder::create([
            'order_number' => 'SO-' . strtoupper(Str::random(6)),
            'user_id' => $user->id,
            'total_amount' => 0,
            'status' => 'confirmed',
        ]);

        foreach ($request->products as $item) {
            $product = Product::find($item['product_id']);
            if (!$product) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Product not found.',
                    'data'    => null 
                ]); 
            }

            if ($product->quantity < $item['quantity']) {
                return response()->json([
                    'status' => false,
                    'message' => 'Insufficient stock for ' . $product->name
                ]);
            }

            $lineTotal = $product->price * $item['quantity'];
            $totalAmount += $lineTotal;

            SalesOrderItem::create([
                'sales_order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $product->price,
                'line_total' => $lineTotal,
            ]);

            //stock update
            $product->decrement('quantity', $item['quantity']);
        }

        //total amount update
        $order->update(['total_amount' => $totalAmount]);
        $order->load('items.product');

        return response()->json([
            'status' => true,
            'message' => 'Order created successfully',
            'order' => $order
        ]);

      } catch (\Exception $e) {
        return response()->json([
                'status'  => false,
                'message' => 'Failed to create sales order. Please try again later.',
            ]); 
        }
    }
}
