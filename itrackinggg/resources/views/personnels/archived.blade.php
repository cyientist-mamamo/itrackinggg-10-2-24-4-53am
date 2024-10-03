@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Archived Personnel</h2>

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
            @forelse($archivedPersonnels as $personnel)
                <tr>
                    <td>{{ $personnel->name }}</td>
                    <td>{{ $personnel->description }}</td>
                    <td>{{ $personnel->working_period }}</td>
                    <td>{{ $personnel->designation }}</td>
                    <td>
                        <form action="{{ route('personnels.restore', $personnel->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Restore</button>
                        </form>
                        <form action="{{ route('personnels.destroy', $personnel->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No archived personnel found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Back Button -->
    <div class="mb-3">
        <a href="{{ route('personnels.index') }}" class="btn btn-secondary">Back to Personnel List</a>
    </div>
</div>
@endsection
