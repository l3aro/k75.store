<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function detail()
    {
        return view('client.product');
    }

    public function shop()
    {
        $products = \App\Models\Product::latest()->paginate(12);

        return view('client.shop', compact('products'));
    }
}
