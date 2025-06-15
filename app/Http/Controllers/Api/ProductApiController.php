<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductApiController extends Controller
{
    public function index()
    {
       $products = Product::all();

        if ($products->isEmpty()) {
            return response()->json([
                'status'  => false, 
                'message' => 'No products found.',
                'data'    => [] 
            ]); 
        }

        return response()->json([
            'status'  => true,
            'message' => 'Products retrieved successfully.',
            'data'    => $products
        ]);
    
    }
}
