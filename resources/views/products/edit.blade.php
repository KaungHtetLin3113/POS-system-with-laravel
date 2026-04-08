@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h4>Edit Product</h4>
        </div>

        <div class="card-body">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.update', $product->id) }}" 
                  method="POST" 
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row">

                    {{-- Product Name --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" 
                               name="name" 
                               class="form-control" 
                               value="{{ old('name', $product->name) }}" 
                               required>
                    </div>

                    {{-- Price --}}
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" 
                               name="price" 
                               class="form-control" 
                               value="{{ old('price', $product->price) }}" 
                               step="0.01"
                               required>
                    </div>

                    {{-- Stock --}}
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" 
                               name="stock" 
                               class="form-control" 
                               value="{{ old('stock', $product->stock) }}" 
                               required>
                    </div>

                    {{-- Category --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Image Upload --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Product Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    {{-- Current Image --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label d-block">Current Image</label>
                        @if($product->image)
                            <img src="{{ asset('images/'.$product->image) }}" 
                                 width="120" 
                                 class="img-thumbnail">
                        @else
                            <p class="text-muted">No image</p>
                        @endif
                    </div>

                   

                </div>

                {{-- Buttons --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        Back
                    </a>

                    <button type="submit" class="btn btn-success">
                        Update Product
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection