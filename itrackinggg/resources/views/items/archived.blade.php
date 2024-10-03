@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Archived Items</h2>
    <a href="{{ route('items.index') }}" class="btn btn-secondary">Back to Item List</a>
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

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
            @foreach($archivedItems as $item)
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
                    <form action="{{ route('items.restore', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">Restore</button>
                    </form>
                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
