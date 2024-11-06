@extends('layouts.app')

@section('content')
<h1 class="mb-4">Edit Item</h1>

<form action="{{ route('inventory.update', $item->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Product Name:</label>
        <input type="text" name="product_name" value="{{ $item->product_name }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Category:</label>
        <input type="text" name="category" value="{{ $item->category }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Quantity:</label>
        <input type="number" name="quantity" value="{{ $item->quantity }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Price:</label>
        <input type="text" name="price" value="{{ $item->price }}" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Update Item</button>
</form>
@endsection