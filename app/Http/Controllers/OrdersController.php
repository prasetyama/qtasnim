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

        $search = $request->search;
        $sort = $request->sort;

        $from = $request->from;
        $to = $request->to;

        if($search || $sort || $from || $to){
            $search_param = array("search" => $search, 'sort' => $sort, 'from' => $from, 'to' => $to);

            $orders = $connectionManager->stream('/orders', 'GET', $search_param, array(), true);
            $orders = $orders["dt"]["data"];
        }

        return view('orders.index', compact('orders'));
    }
}
