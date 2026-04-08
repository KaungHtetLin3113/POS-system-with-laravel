@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Add Product</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Product Name -->
                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" 
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" placeholder="Enter product name">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Price -->
                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" 
                        class="form-control @error('price') is-invalid @enderror"
                        value="{{ old('price') }}" placeholder="Enter price">

                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Stock -->
                <div class="mb-3">
                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" 
                        class="form-control @error('stock') is-invalid @enderror"
                        value="{{ old('stock') }}" placeholder="Enter stock">

                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Category -->
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" 
                        class="form-select @error('category_id') is-invalid @enderror">

                        <option disabled selected>Select Category</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div class="mb-3">
                    <label class="form-label">Product Image</label>
                    <input type="file" name="image" id="imageInput"
                        class="form-control @error('image') is-invalid @enderror">

                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image Preview -->
                <div class="mb-3 text-center">
                    <img id="imageInput" src="#" 
                        class="img-fluid rounded shadow" 
                        style="max-height: 200px; display: none;">
                </div>

                <!-- Button -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4">
                        Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
@endsection
