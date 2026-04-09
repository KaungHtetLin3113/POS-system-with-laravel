@extends('layouts.app')

@section('content')

<a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Category</th>
         
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
             <td>
                @if($product->image)
                    <img src="{{ asset('images/'.$product->image) }}" width="80">
                @endif
            </td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->category->name }}</td>
           
            <td>
                  <!-- ✅ ADD TO CART FORM HERE -->
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf

            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <input type="hidden" name="qty" value="1" min="1" class="form-control mb-2">

            <button class="btn btn-success">Add to Cart</button>
        </form>
            </td>

            <td>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>

                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger"
                      onclick="confirmDelete">
                        Delete
                    </button>
                   
 @if(session('success'))
<script>
    
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: true
    });
</script>
@endif
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This category will be deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>