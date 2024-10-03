@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Borrowers Log</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('equipments.index') }}" class="btn btn-secondary mb-3">Back to Equipment List</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Equipment</th>
                <th>Name</th>
                <th>Office</th>
                <th>NO</th>
                <th>Date Borrowed</th>
                <th>Date Returned</th>
                <th>Action</th> <!-- New column for actions -->
            </tr>
        </thead>
        <tbody>
            @foreach($borrowLogs as $log)
                <tr>
                    <td>{{ $log->equipment->description }}</td>
                    <td>{{ $log->name }}</td>
                    <td>{{ $log->office }}</td>
                    <td>{{ $log->no }}</td>
                    <td>{{ $log->date_borrowed }}</td>
                    <td>{{ $log->date_returned }}</td>
                    <td>
                        <form action="{{ route('borrowlogs.return', $log->id) }}" method="POST" style="display:inline;" onsubmit="return confirmReturn();">
                            @csrf
                            <button type="submit" class="btn btn-success">Returned</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function confirmReturn() {
        return confirm('Is this equipment returned?');
    }
</script>
@endsection
