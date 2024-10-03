@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Equipment List</h2>
    <a href="{{ route('equipments.create') }}" class="btn btn-primary mb-3">Add Equipment</a>
    <a href="{{ route('equipments.archived') }}" class="btn btn-secondary mb-3">View Archived Equipment</a>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Accounting Officer</th>
                <th>Operating Unit/Project</th>
                <th>PN(Code)</th>
                <th>Responsible Person</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Description</th>
                <th>Date Acquired</th>
                <th>Fund</th>
                <th>PPE Class</th>
                <th>Est Useful Life</th>
                <th>Unit Price</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach($equipments as $equipment)
            <tr>
                <td>{{ $equipment->accounting_officer }}</td>
                <td>{{ $equipment->operating_unit_project }}</td>
                <td>{{ $equipment->pn_code }}</td>
                <td>{{ $equipment->responsiblePerson->name }}</td>
                <td>{{ $equipment->quantity }}</td>
                <td>{{ $equipment->unit }}</td>
                <td>{{ $equipment->description }}</td>
                <td>{{ $equipment->date_acquired }}</td>
                <td>{{ $equipment->fund }}</td>
                <td>{{ $equipment->ppe_class }}</td>
                <td>{{ $equipment->est_useful_life }}</td>
                <td>{{ $equipment->unit_price }}</td>
                <td>{{ $equipment->total_amount }}</td>
                <td>{{ $equipment->status }}</td>
                <td>
                    <!-- Edit button -->
                    <a href="{{ route('equipments.edit', $equipment->id) }}" class="btn btn-warning">Edit</a>

                    <!-- Archive button -->
                    <form action="{{ route('equipments.destroy', $equipment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Archive</button>
                    </form>

                    <!-- Conditionally show the Borrow button if not borrowed -->
                    @if($equipment->status !== 'borrowed')
                    <a href="{{ route('equipments.borrow', $equipment->id) }}" class="btn btn-info">Borrow</a>
                    @endif

                    <!-- Conditionally show the Condemn button if status is 'missing_reported_spmo' -->
                    @if($equipment->status == 'missing_reported_spmo')
                    <form action="{{ route('equipments.condemn', $equipment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-dark">Condemn</button>
                    </form>
                    @endif
                </td>


            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<a href="{{ route('borrow-logs.index') }}" class="btn btn-primary">View Borrowers Log</a>
@endsection