@extends('layouts.app')

@section('content')

<div class="container">

    <!-- 🔍 SEARCH + ADD BUTTON -->
    <div class="d-flex justify-content-between mb-3">
        <form method="GET" action="{{ route('products.index') }}" class="w-50">
            <div class="input-group">
                <input 
                    type="text" 
                    name="search" 
                    class="form-control" 
                    placeholder="Search product..."
                    value="{{ request('search') }}"
                >
                <button class="btn btn-primary">Search</button>
            </div>
       
        </form>

        <a href="{{ route('products.create') }}" class="btn btn-success">
            + Add Product
        </a>
    </div>

    <!-- SUCCESS MESSAGE (NORMAL) -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- 📦 PRODUCT TABLE -->
    <table class="table table-bordered table-hover text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Category</th>
                <th width="250">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($products as $product)
            <tr>

                <!-- Image -->
                <td>
                    @if($product->image)
                        <img src="{{ asset('images/'.$product->image) }}" width="70" class="rounded">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </td>

                <!-- Data -->
                <td>{{ $product->name }}</td>
                <td>{{ number_format($product->price, 0) }} Ks</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->category->name ?? 'No Category' }}</td>

                <!-- Actions -->
                <td>

                    <!-- Add to Cart -->
                    <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="qty" value="1">
                        <button class="btn btn-success btn-sm">Add</button>
                    </form>

                    <!-- Edit -->
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <!-- Delete -->
                    <form action="{{ route('products.destroy', $product->id) }}" 
                          method="POST" 
                          class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm delete-btn">
                            Delete
                        </button>
                    </form>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">No products found</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection


<!-- ✅ SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // ✅ DELETE CONFIRMATION
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            let form = this.closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to undo this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // ✅ SUCCESS POPUP
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
            timer: 2000,
            showConfirmButton: false
        });
    @endif
</script>