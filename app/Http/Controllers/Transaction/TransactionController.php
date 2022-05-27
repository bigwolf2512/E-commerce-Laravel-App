<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        //$data = Transaction::all();
        $data = Transaction::all();
        return response()->json(['data' => $data], 200);
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        // $request = [
        //     'quantity'
        //     'buyer_id'
        //     'product_id'
        // ];
        $product = Product::find($request->product_id);
        $productQuantity = $product->quantity_available - $request->quantity;
        if ($productQuantity < 0) {
            return response()->json(['message' => 'This product does not have enough quantity you need. Please try again.'], 400);
        }
        $product->quantity_available = $productQuantity;
        $product->save();
        $transaction = Transaction::all();
        if ($transaction->contains('buyer_id', $request->buyer_id)) {
            $transactions_buyer_id = Transaction::where('buyer_id', $request->buyer_id)->get();
            if ($transactions_buyer_id->contains('product_id', $request->product_id)) {
                $transactions_buyer_product_id =
                    Transaction::where('buyer_id', $request->buyer_id)
                    ->where('product_id', $request->product_id)->first();
                $transactions_buyer_product_id->quantity = $request->quantity;
                $transactions_buyer_product_id->save();
            } else {
                $transaction = Transaction::create([
                    "quantity" => $request->quantity,
                    "buyer_id" => $request->buyer_id,
                    "product_id" => $request->product_id
                ]);
            }
        } else {
            $transaction = Transaction::create([
                "quantity" => $request->quantity,
                "buyer_id" => $request->buyer_id,
                "product_id" => $request->product_id
            ]);
        }
        return response()->json(Transaction::where('buyer_id', $request->buyer_id)->get(), 200);
    }

    public function show(int $id)
    {
        $data = Transaction::where('buyer_id', $id)->get();
        return response()->json($data, 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::where('buyer_id', '=', $id)
            ->where('product_id', '=', $request->product_id)->first();
        if ($request->has('quantity')) {
            $transaction->quantity = $request->quantity;
        }
        if ($transaction->isDirty()) {
            $transaction->save();
        }
        return response()->json($transaction, 200);
    }

    public function destroy($id)
    {
    }
    public function removeTransactions(Request $req)
    {
        $transaction = Transaction::where('buyer_id', $req->buyerId)
            ->where('product_id', $req->productId)->first();
        $transaction->delete();

        return response()->json(['message' => "Remove successful"], 200);
    }
}
