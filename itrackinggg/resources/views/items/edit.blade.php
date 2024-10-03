@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Edit Item</h2>
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

    <form action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" name="description" value="{{ $item->description }}" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control" name="category" value="{{ $item->category }}" required>
        </div>
        <div class="mb-3">
            <label for="unit" class="form-label">Unit</label>
            <input type="text" class="form-control" name="unit" value="{{ $item->unit }}" required>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" name="quantity" value="{{ $item->quantity }}" required>
        </div>
        <div class="mb-3">
            <label for="used" class="form-label">Used</label>
            <input type="number" class="form-control" name="used" value="{{ $item->used }}" required>
        </div>
        <div class="mb-3">
            <label for="added" class="form-label">Added Date</label>
            <input type="date" class="form-control" name="added" value="{{ $item->added }}" required>
        </div>
        <div class="mb-3">
            <label for="expiry_date" class="form-label">Expiry Date</label>
            <input type="date" class="form-control" name="expiry_date" value="{{ $item->expiry_date }}" required>
        </div>
        <div class="mb-3">
            <label for="consume_type" class="form-label">Consume Type</label>
            <select class="form-select" name="consume_type" required>
                <option value="Consumable" {{ $item->consume_type == 'Consumable' ? 'selected' : '' }}>Consumable</option>
                <option value="Non-Consumable" {{ $item->consume_type == 'Non-Consumable' ? 'selected' : '' }}>Non-Consumable</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Item</button>
    </form>
</div>
@endsection