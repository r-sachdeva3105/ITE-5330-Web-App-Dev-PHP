@extends('layouts.app')

@section('content')
<h1 class="mb-4">Inventory List</h1>

<a href="{{ route('inventory.create') }}" class="btn btn-primary mb-3">Add New Item</a>

<table class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->product_name }}</td>
            <td>{{ $item->category }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->price }}</td>
            <td>
                <a href="{{ route('inventory.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('inventory.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection