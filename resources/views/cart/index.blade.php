@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">🛒 Cart</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered text-center">
        <thead class="table-success">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carts as $cart)
            <tr>
                <td>{{ $cart->product->name }}</td>
                <td>{{ $cart->price }}</td>

                <!-- ✅ QTY CONTROLS -->
                <td>
                    <div class="d-flex justify-content-center">

                        <!-- ➖ Decrease -->
                        <form action="{{ route('cart.decrease', $cart->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger btn-sm">-</button>
                        </form>

                        <span class="mx-2">{{ $cart->qty }}</span>

                        <!-- ➕ Increase -->
                        <form action="{{ route('cart.increase', $cart->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-success btn-sm">+</button>
                        </form>

                    </div>
                </td>

                <td>{{ $cart->total }}</td>

                <!-- ❌ REMOVE -->
                <td>
                    <form action="{{ route('cart.remove', $cart->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-warning btn-sm">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- ✅ GRAND TOTAL -->
    <h4 class="text-end">Grand Total: {{ $grandTotal }}</h4>
</div>
@endsection