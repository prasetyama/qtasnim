<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Products;

class OrdersController extends Controller
{
    public function index(Request $request){

        $search = $request->search;
        $sort = $request->sort;
        $from = $request->from;
        $to = $request->to;

        $orders = Orders::join('products', 'products.id', '=', 'orders.product_id')
            ->select('orders.*', 'products.product_name');

        if ($search){
            $orders = $orders->where('products.product_name', 'like', "%".$search."%");
        }

        if ($sort){
            if ($sort == "n-asc"){
                $orders = $orders->orderBy('products.product_name', 'asc');
            } else if ($sort == "n-desc"){
                $orders = $orders->orderBy('products.product_name', 'desc');
            } else if ($sort == "u-desc"){
                $orders = $orders->orderBy('orders.created_at', 'desc');
            } else if ($sort == "u-asc"){
                $orders = $orders->orderBy('orders.created_at', 'asc');
            }
        }

        if ($from || $to){
            $orders = $orders->whereBetween('orders.created_at', [$from, $to]);
        }

        $orders = $orders->get();

        return response()->json([
            'success' => true,
            'data' => $orders
        ], 200);
    }
}
