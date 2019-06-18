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
        return view('client.shop');
    }
}
