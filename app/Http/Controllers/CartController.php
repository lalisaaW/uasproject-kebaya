<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kebaya;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $kebayas = Kebaya::whereIn('ID_KEBAYA', array_keys($cart))->get();
        return view('cart.index', compact('cart', 'kebayas'));
    }

    public function add(Kebaya $kebaya)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$kebaya->ID_KEBAYA])) {
            $cart[$kebaya->ID_KEBAYA]['quantity']++;
        } else {
            $cart[$kebaya->ID_KEBAYA] = [
                'quantity' => 1,
                'price' => $kebaya->HARGA_SEWA
            ];
        }
        
        Session::put('cart', $cart);
        return redirect()->back()->with('success', 'Kebaya added to cart successfully!');
    }

    public function remove(Kebaya $kebaya)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$kebaya->ID_KEBAYA])) {
            unset($cart[$kebaya->ID_KEBAYA]);
            Session::put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Kebaya removed from cart successfully!');
    }

    public function update(Request $request)
    {
        $cart = Session::get('cart', []);
        
        foreach ($request->quantity as $kebayaId => $quantity) {
            if (isset($cart[$kebayaId])) {
                $cart[$kebayaId]['quantity'] = max(1, (int)$quantity);
            }
        }
        
        Session::put('cart', $cart);
        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    public function clear()
    {
        Session::forget('cart');
        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }
}
