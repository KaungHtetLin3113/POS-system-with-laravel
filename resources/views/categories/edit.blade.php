@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Category</h2>
 @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form method="POST" action="{{ route('categories.update', $category->id) }}">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $category->name }}" class="form-control mb-2">
        <textarea name="description" class="form-control mb-2">{{ $category->description }}</textarea>

        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection