<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders;

        $carts = $orders->transform( function( $cart, $key) {
            return unserialize($cart->cart);
        });
//        dd($carts);
        return view('order.index', compact('carts'));
    }
}
