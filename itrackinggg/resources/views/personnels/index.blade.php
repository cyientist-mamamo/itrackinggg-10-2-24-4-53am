@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Personnel List</h2>
    <a href="{{ route('personnels.create') }}" class="btn btn-primary mb-3">Add Personnel</a>
    <a href="{{ route('personnels.archived') }}" class="btn btn-secondary mb-3">View Archived Personnel</a> <!-- New Button -->

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Working Period</th>
                <th>Designation</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach($personnels as $personnel)
                <tr>
                    <td>{{ $personnel->name }}</td>
                    <td>{{ $personnel->description }}</td>
                    <td>{{ $personnel->working_period }}</td>
                    <td>{{ $personnel->designation }}</td>
                    <td>
                        <a href="{{ route('personnels.edit', $personnel->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('personnels.destroy', $personnel->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Archive</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
