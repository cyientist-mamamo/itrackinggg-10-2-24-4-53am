@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Item Details</h2>
    <p><strong>Description:</strong> {{ $item->description }}</p>
    <p><strong>Category:</strong> {{ $item->category }}</p>
    <p><strong>Unit:</strong> {{ $item->unit }}</p>
    <p><strong>Quantity:</strong> {{ $item->quantity }}</p>
    <p><strong>Used:</strong> {{ $item->used }}</p>
    <p><strong>Added:</strong> {{ $item->added }}</p>
    <p><strong>Expiry Date:</strong> {{ $item->expiry_date }}</p>
    <p><strong>Consume Type:</strong> {{ $item->consume_type }}</p>
    <a href="{{ route('items.index') }}" class="btn btn-secondary">Back to Item List</a>
</div>
@endsection
