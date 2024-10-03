@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Archived Equipment</h2>
    <a href="{{ route('equipments.index') }}" class="btn btn-secondary mb-3">Back to Equipment List</a>

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
            @foreach($archivedEquipments as $equipment)
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
                        <form action="{{ route('equipments.restore', $equipment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Restore</button>
                        </form>
                        <form action="{{ route('equipments.destroy', $equipment->id) }}" method="POST" style="display:inline;">
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
