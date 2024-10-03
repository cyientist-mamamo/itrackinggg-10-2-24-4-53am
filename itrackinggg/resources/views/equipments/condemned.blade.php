@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Condemned Equipment</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Accounting Officer</th>
                <th>Operating Unit/Project</th>
                <th>PN Code</th>
                <th>Responsible Person ID</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Description</th>
                <th>Date Acquired</th>
                <th>Fund</th>
                <th>PPE Class</th>
                <th>Estimated Useful Life</th>
                <th>Unit Price</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Date Condemned</th>
            </tr>
        </thead>
        <tbody>
            @foreach($condemnedEquipments as $equipment)
                <tr>
                    <td>{{ $equipment->id }}</td>
                    <td>{{ $equipment->accounting_officer }}</td>
                    <td>{{ $equipment->operating_unit_project }}</td>
                    <td>{{ $equipment->pn_code }}</td>
                    <td>{{ $equipment->responsible_person_id }}</td>
                    <td>{{ $equipment->quantity }}</td>
                    <td>{{ $equipment->unit }}</td>
                    <td>{{ $equipment->description }}</td>
                    <td>{{ $equipment->date_acquired }}</td>
                    <td>{{ $equipment->fund }}</td>
                    <td>{{ $equipment->ppe_class }}</td>
                    <td>{{ $equipment->est_useful_life }}</td>
                    <td>{{ number_format($equipment->unit_price, 2) }}</td>
                    <td>{{ number_format($equipment->total_amount, 2) }}</td>
                    <td>{{ $equipment->status }}</td>
                    <td>{{ $equipment->created_at->format('Y-m-d H:i:s') }}</td> <!-- Assuming created_at is used for the date condemned -->
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Back to Equipment List Button -->
    <div class="mt-4">
        <a href="{{ route('equipments.index') }}" class="btn btn-secondary">Back to Equipment List</a>
    </div>
</div>
@endsection
