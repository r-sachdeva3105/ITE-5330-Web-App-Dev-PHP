@extends('layouts.app')

@section('content')
<h1 class="mb-4">Item Details</h1>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $item->product_name }}</h5>
        <p class="card-text"><strong>Category:</strong> {{ $item->category }}</p>
        <p class="card-text"><strong>Quantity:</strong> {{ $item->quantity }}</p>
        <p class="card-text"><strong>Price:</strong> ${{ $item->price }}</p>
    </div>
</div>

<a href="{{ route('inventory.index') }}" class="btn btn-secondary mt-3">Back to Inventory</a>
@endsection