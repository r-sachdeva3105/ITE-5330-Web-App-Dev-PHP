@extends('layouts.app')

@section('content')
<h1 class="mb-4">Add New Item</h1>

<form action="{{ route('inventory.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Product Name:</label>
        <input type="text" name="product_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Category:</label>
        <input type="text" name="category" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Quantity:</label>
        <input type="number" name="quantity" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Price:</label>
        <input type="text" name="price" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Add Item</button>
</form>
@endsection