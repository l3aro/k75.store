<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;
use App\Models\Product;
use App\Models\Order;

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

    public function remove(Request $request)
    {
        Cart::remove($request->id);

        $quantity = Cart::getTotalQuantity();

        return response()->json(compact('quantity'), 200);
    }

    public function update(Request $request)
    {
        Cart::update($request->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->quantity
            ),
        ));

        $quantity = Cart::getTotalQuantity();

        return response()->json(compact('quantity'), 200);
    }

    public function submit(Request $request)
    {
        $attributes = $request->only([
            'client_name', 'address', 'email', 'phone'
        ]);
        $attributes['status'] = 'waiting';

        $order = Order::create($attributes);

        foreach (Cart::getContent() as $cart) {
            $order->orderDetails()->create([
                'product_id' => $cart->id,
                'quantity' => $cart->quantity,
                'price' => $cart->price
            ]);
        }
        Cart::clear();
        return redirect()->route('client.cart.complete');
    }
}
