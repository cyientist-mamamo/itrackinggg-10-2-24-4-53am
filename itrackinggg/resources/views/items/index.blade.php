@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Item List</h2>
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

    <a href="{{ route('items.create') }}" class="btn btn-primary">Add Item</a>
    <a href="{{ route('items.archived') }}" class="btn btn-secondary">View Archived Items</a>
    
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Number</th>
                <th>Description</th>
                <th>Category</th>
                <th>Unit</th>
                <th>Quantity</th>
                <th>Used</th>
                <th>Added</th>
                <th>Expiry Date</th>
                <th>Consume Type</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->category }}</td>
                <td>{{ $item->unit }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->used }}</td>
                <td>{{ $item->added }}</td>
                <td>{{ $item->expiry_date }}</td>
                <td>{{ $item->consume_type }}</td>
                <td>
                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('items.archive', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Archive</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
