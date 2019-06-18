<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.order.index');
    }

    public function processed()
    {
        return view('admin.order.processed');
    }

    public function edit()
    {
        return view('admin.order.detail');
    }
}
