@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Categories</h2>

    <a href="{{ route('categories.create') }}" class="btn btn-primary">Add</a>

    <table class="table mt-3">
       @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

        <tr>
            
            <th>Name</th>
            <th>Action</th>
        </tr>

        @foreach($categories as $cat)
        <tr>

            <td>{{ $cat->name }}</td>
            <td>
                <a href="{{ route('categories.edit', $cat->id) }}" class="btn btn-warning">Edit</a>

                <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" style="display:inline;">
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
        showConfirmButton: false
    });
</script>
@endif
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
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