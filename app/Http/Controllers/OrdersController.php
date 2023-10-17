<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Core\ConnectionManager;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $connectionManager = new ConnectionManager(env('API_URL'));
        $out = $connectionManager->stream('/orders', 'GET', array(), array(), true);
        $orders = $out["dt"]["data"];

        // $search = $request->search;

        // if($search){
        //     $products = Products::where('product_name','like',"%".$search."%")
        //     ->paginate();
        // }

        return view('orders.index', compact('orders'));
    }
}
