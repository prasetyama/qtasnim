<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function index(Request $request){
        $products = Products::latest();

        $sort = $request->sort;
        $search = $request->search;

        if ($sort){
            if ($sort == "n-asc"){
                $products = $products->orderBy('product_name', 'asc');
            } else if ($sort == "n-desc"){
                $products = $products->orderBy('product_name', 'desc');
            } else if ($sort == "u-desc"){
                $products = $products->orderBy('created_at', 'desc');
            } else if ($sort == "u-asc"){
                $products = $products->orderBy('created_at', 'asc');
            }
        }

        if ($search){
            $products = $products->where('product_name', 'like', "%".$search."%");
        }

        $products = $products->get();

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
}
