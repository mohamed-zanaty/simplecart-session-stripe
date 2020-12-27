<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        if (session('success'))
            toast(session('success'), 'success');
        $products = Product::all();
        return view('product.index', compact('products'));
    }


    public function addToCart($id)
    {

        $product = Product::findOrFail($id);
        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = new Cart();
        }
        $cart->add($product);
        session()->put('cart', $cart);
        return redirect()->route('products.index')->with('success', 'product was added');
    }

    public function showCart()
    {
        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = new Cart();
        }

        return view('cart.index', compact('cart'));
    }

    public function check($amount)
    {
        return view('cart.check', compact('amount'));
    }

    public function charge(Request $request)
    {
        $charge = Stripe::charges()->create([
            'currency' => 'USD',
            'source' => $request->stripeToken,
            'amount' => $request->amount,
            'description' => 'test from mohamed zanaty',
        ]);

        $chargeId = $charge['id'];
        if ($chargeId) {

            auth()->user()->orders()->create([
               'cart' => serialize(session()->get('cart')),
            ]);
            session()->forget('cart');
            return redirect()->route('products.index')->with('success', 'payment was succeeded');
        } else
            return redirect()->route('products.index')->with('error', ' there are an error in payment try later');

    }
    public function delete($id){
        $product = Product::find($id);
        $cart = new Cart(session()->get('cart'));
        $cart->remove($product->id);
        if ($cart->totalQty <= 0){
            session()->forget('cart');
        } else{
            session()->put('cart', $cart);
        }
        return redirect()->route('products.index')->with('success', 'product was deleted');
    }
    public function edit($id, Request $request){
        $product = Product::find($id);

        $request->validate([
            'qty' => 'required|numeric|min:1'
        ]);

        $cart = new Cart(session()->get('cart'));
        $cart->updateQty($product->id, $request->qty);
        session()->put('cart', $cart);
        return redirect()->route('products.index')->with('success', 'Product updated');
    }
}
