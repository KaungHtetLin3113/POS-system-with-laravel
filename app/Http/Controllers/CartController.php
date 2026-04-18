<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
// use App\Http\Controllers\OrderItem;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\OrderItem;

class CartController extends Controller
{
    public function add(Request $request)
    {
        // dd(session('cart'));
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
    // Check Out order
    public function checkout()
    {
        $cartItems = Cart::all();

        // ❌ No cart
        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Cart is empty');
        }

        // ✅ Calculate total
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item->total;
        }

        // 🔥 STEP 1: Create Order
        $order = Order::create([
            'total' => $total
        ]);

        // 🔥 STEP 2: Save Order Items
        foreach ($cartItems as $item) {

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'qty' => $item->qty,
                'price' => $item->price
            ]);

            // 🔥 Reduce stock
            $product = Product::find($item->product_id);
            if ($product) {
                $product->stock -= $item->qty;
                $product->save();
            }
        }

        // 🔥 STEP 3: Clear Cart
        Cart::truncate();

        return back()->with('success', 'Order saved successfully!');
    }
}
