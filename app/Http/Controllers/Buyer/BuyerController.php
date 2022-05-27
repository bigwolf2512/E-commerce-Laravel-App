<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Seller;

class BuyerController extends Controller
{
    public function index()
    {
        $buyer = Buyer::has('transactions')->get();
        return response()->json($buyer, 200);
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
    }
    public function show(int $id)
    {
        $buyer = Buyer::findOrFail($id);
        $data  = $buyer->transactions;
        return response()->json(['data' => $data], 200);
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
        //
    }
}
