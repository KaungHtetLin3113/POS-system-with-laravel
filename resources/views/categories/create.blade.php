@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Category</h2>
 @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form method="POST" action="{{ route('categories.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Name" class="form-control mb-2" value="{{ old('name') }}">
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <textarea placeholder="Description but not need!" name="description" class="form-control mb-2">{{old ('name')}}</textarea>

        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection