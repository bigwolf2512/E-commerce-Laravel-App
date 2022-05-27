<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller

{
    public function getProductByCategories(int $id)
    {
        $category_id = $id;
        $product_id = DB::table('category_product')
            ->where('category_id', '=', $category_id)->pluck('product_id');
        for ($i = 0; $i < count($product_id); $i++) {
            $products = Product::findOrFail($product_id);
        }
        return response()->json(['products' => $products], 200);
    }
    public function index()
    {
        $product = Product::get();
        return response()->json([
            'products' => $product
        ], 200);
    }
    public function store(Request $request)
    {
        $rules = [
            'seller_id' => 'required|string',
            'category_id' => 'required|string',
            'name' => 'required|string',
            'price' => 'required|string',
            'description' => 'required|string',
            'quantity_available' => 'required|string',
            'image' => 'required|string'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $category = Category::find($request->category_id);
        if ($category == null) {
            return response()->json([
                "message" => "Please enter the available categories."
            ], 400);
        }
        $product = Product::create([
            "seller_id" => $request->seller_id,
            "name" => $request->name,
            "price" =>  $request->price,
            "description" =>  $request->description,
            "quantity_available" =>  $request->quantity_available,
            "status" => 'available',
            "image" =>  $request->image,
        ]);
        $category_product = DB::table('category_product')->insert(
            [
                'category_id' => $category->id,
                'product_id' => $product->id
            ]
        );
        $product->save();
        return response()->json([
            "products" => $product,
            "categories" => $category_product
        ], 200);
    }
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json(['products' => $product], 200);
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete()->save();
        return response()->json(['message' => 'Removed successfull.'], 200);
    }
}
