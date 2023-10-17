<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;

class OrdersController extends Controller
{
    public function index(){

        $orders = Orders::join('products', 'products.id', '=', 'orders.product_id')
            ->select('orders.*', 'products.product_name')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $orders
        ], 200);
    }
}
