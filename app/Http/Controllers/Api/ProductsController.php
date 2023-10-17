<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function index(){
        $products = Products::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $products
        ], 200);
    }

    public function add(Request $request){

        $product_name = $request->product_name;
        $product_type = $request->product_type;
        $stock = $request->stock;

        $validator = Validator::make($request->all(), [
            'product_name'      => 'required',
            'product_type'      => 'required',
            'stock'  => 'required|numeric|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Products::create([
            'product_name' => $product_name,
            'product_type' => $product_type,
            'stock' => $stock
        ]);

        return response()->json([
            'success' => true,
            'data' => $product
        ], 200);
    }

    public function detail(Request $request, $id){
        $product = Products::Where('id', '=', $id)->first();

        return response()->json([
            'success' => true,
            'data' => $product
        ], 200);
    }

    public function update(Request $request, $id){

        $product_name = $request->product_name;
        $product_type = $request->product_type;
        $stock = $request->stock;

        $validator = Validator::make($request->all(), [
            'product_name'      => 'required',
            'product_type'      => 'required',
            'stock'  => 'required|numeric|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $update = Products::where('id', $id)->update(
            ['product_name' => $product_name],
            ['product_type' => $product_type],
            ['stock' => $stock]
        );

        return response()->json([
            'success' => true,
        ], 200);
    }

    public function delete(Request $request, $id){
        $product = Products::Where('id', '=', $id)->first();

        $product->delete();

        return response()->json([
            'success' => true
        ], 200);
    }

    public function search(Request $request){

        $search = $request->search;

        $products = Products::where('product_name', 'like', "%".$search."%")->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ], 200);
    }
}
