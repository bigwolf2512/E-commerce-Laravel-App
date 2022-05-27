<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CartController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        $product_id = Transaction::where('buyer_id', $id)->pluck('product_id');
        $quantity = Transaction::where('buyer_id', $id)->pluck('quantity');

        $cart = Cart::findOrFail($product_id)->map(function ($cart) {
            $cart->quantity = 0;
            // $cart->buyer_id = 0;
            return $cart;
        })->makeHidden(['quantity_available', 'updated_at', 'status', 'created_at'])->toArray();
        for ($i = 0; $i < count($quantity); $i++) {
            Arr::set($cart, $i . '.quantity', $quantity[$i]);
            // Arr::set($cart, $i . '.buyer_id', (int)$id);
        }

        return response()->json(['carts' => $cart], 200);
    }
    public function edit(Cart $cart)
    {
        //
    }
    public function update(Request $request, Cart $cart)
    {
        //
    }
    public function destroy(Cart $cart)
    {
    }
}
