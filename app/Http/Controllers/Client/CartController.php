<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function cart()
    {
        return view('client.cart');
    }

    public function checkout()
    {
        return view('client.checkout');
    }

    public function complete()
    {
        return view('client.complete');
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        Cart::add([
            'id' => $request->product_id,
            'quantity' => $request->has('quantity')?$request->quantity:1,
            'price' => $product->price,
            'name' => $product->name,
            'attributes' => []
        ]);

        return response()->json([
            'quantity' => Cart::getTotalQuantity()
        ], 200);
    }
}
