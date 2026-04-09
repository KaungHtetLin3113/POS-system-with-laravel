<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $qty = $request->qty;

        // ✅ Validation
        if ($qty < 1) {
            return back()->with('error', 'Invalid quantity');
        }

        if ($qty > $product->stock) {
            return back()->with('error', 'Not enough stock');
        }

        // ✅ Reduce stock
        $product->stock -= $qty;
        $product->save();

        // ✅ Check if already in cart
        $cart = Cart::where('product_id', $product->id)->first();

        if ($cart) {
            // Update existing
            $cart->qty += $qty;
            $cart->total = $cart->qty * $cart->price;
            $cart->save();
        } else {
            // Create new
            Cart::create([
                'product_id' => $product->id,
                'qty' => $qty,
                'price' => $product->price,
                'total' => $product->price * $qty,
            ]);
        }

        return back()->with('success', 'Added to cart');
    }

    public function index()
    {
        $carts = Cart::with('product')->get();
        $grandTotal = $carts->sum('total');

        return view('cart.index', compact('carts', 'grandTotal'));
    }
    // increase function
    public function increase($id)
    {
        $cart = Cart::findOrFail($id);
        $product = $cart->product;

        if ($product->stock < 1) {
            return back()->with('error', 'No more stock');
        }

        $cart->qty += 1;
        $cart->total = $cart->qty * $cart->price;
        $cart->save();

        $product->stock -= 1;
        $product->save();

        return back();
    }

    // decrease function
    public function decrease($id)
    {
        $cart = Cart::findOrFail($id);
        $product = $cart->product;

        if ($cart->qty <= 1) {
            return back();
        }

        $cart->qty -= 1;
        $cart->total = $cart->qty * $cart->price;
        $cart->save();

        $product->stock += 1;
        $product->save();

        return back();
    }

    // remove function
    public function remove($id)
    {
        $cart = Cart::findOrFail($id);
        $product = $cart->product;

        // Restore stock
        $product->stock += $cart->qty;
        $product->save();

        $cart->delete();

        return back()->with('success', 'Item removed');
    }
}
