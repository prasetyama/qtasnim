<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Products;

class OrdersController extends Controller
{
    public function index(Request $request){

        $from = $request->from;
        $to = $request->to;

        $orders = Orders::join('products', 'products.id', '=', 'orders.product_id')
            ->select('orders.*', 'products.product_name')
            ->get();

        if ($from && $to){
            $orders = Orders::join('products', 'products.id', '=', 'orders.product_id')
                    ->select('orders.*', 'products.product_name')
                    ->whereBetween('orders.created_at', [$from, $to])
                    ->get();
        }

        return response()->json([
            'success' => true,
            'data' => $orders
        ], 200);
    }

    public function search(Request $request){

        $search = $request->search;

        $sort = $request->sort;

        if ($sort){
            if ($sort == "n-asc"){
                $products = Orders::join('products', 'products.id', '=', 'orders.product_id')
                        ->select('orders.*', 'products.product_name')
                        ->where('products.product_name', 'like', "%".$search."%")->orderBy('products.product_name', 'asc')->get();
            } else if ($sort == "n-desc"){
                $products = Orders::join('products', 'products.id', '=', 'orders.product_id')
                        ->select('orders.*', 'products.product_name')
                        ->where('products.product_name', 'like', "%".$search."%")->orderBy('products.product_name', 'desc')->get();
            } else if ($sort == "u-desc"){
                $products = Orders::join('products', 'products.id', '=', 'orders.product_id')
                            ->select('orders.*', 'products.product_name')
                            ->where('products.product_name', 'like', "%".$search."%")->orderBy('orders.created_at', 'desc')->get();
            } else if ($sort == "u-asc"){
                $products = Orders::join('products', 'products.id', '=', 'orders.product_id')
                            ->select('orders.*', 'products.product_name')
                            ->where('products.product_name', 'like', "%".$search."%")->orderBy('orders.created_at', 'asc')->get();
            }
        } else {
            $products = Orders::join('products', 'products.id', '=', 'orders.product_id')
                    ->select('orders.*', 'products.product_name')
                    ->where('products.product_name', 'like', "%".$search."%")->get();
        }

        return response()->json([
            'success' => true,
            'data' => $products
        ], 200);
    }
}
