<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Core\ConnectionManager;

class ProductsController extends Controller
{
   
    public function index(Request $request)
    {
        $connectionManager = new ConnectionManager(env('API_URL'));
        $out = $connectionManager->stream('/products', 'GET', array(), array(), true);
        $products = $out["dt"]["data"]["data"];

        // $search = $request->search;

        // if($search){
        //     $products = Products::where('product_name','like',"%".$search."%")
        //     ->paginate();
        // }

        return view('products.index', compact('products'));
    }

    public function add(Request $request){
        return view('products.add');
    }

    public function store(Request $request){

        $data = array(
            "product_name" => $request->product_name, 
            "product_type" => $request->product_type,
            "stock" => $request->stock
        );

        $connectionManager = new ConnectionManager(env('API_URL'));
        $out = $connectionManager->stream('/products', 'POST', $data, array(), true);

        return redirect()->route('products.index')
            ->withSuccess(__('Product created successfully.'));
    }

    public function delete(Request $request, $id){

        $connectionManager = new ConnectionManager(env('API_URL'));
        $out = $connectionManager->stream('/products/' . $id, 'DELETE', array(), array(), true);

        return redirect()->route('products.index')
            ->withSuccess(__('Product deleted successfully.'));

    }

    public function edit($id){
        $connectionManager = new ConnectionManager(env('API_URL'));
        $out = $connectionManager->stream('/products/' . $id, 'GET', array(), array(), true);
        $product = $out["dt"]["data"];

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id){

        $data = array(
            "product_name" => $request->product_name, 
            "product_type" => $request->product_type,
            "stock" => $request->stock
        );

        $connectionManager = new ConnectionManager(env('API_URL'));
        $out = $connectionManager->stream('/products/' . $id, 'PATCH', $data, array(), true);

        return redirect()->route('products.index')
            ->withSuccess(__('Product Update successfully.'));

    }
}
