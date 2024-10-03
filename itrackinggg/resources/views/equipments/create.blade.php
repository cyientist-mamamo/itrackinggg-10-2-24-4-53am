@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Add Equipment</h2>
    <form action="{{ route('equipments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="accounting_officer" class="form-label">Accounting Officer</label>
            <input type="text" class="form-control" name="accounting_officer" required>
        </div>
        <div class="mb-3">
            <label for="operating_unit_project" class="form-label">Operating Unit/Project</label>
            <input type="text" class="form-control" name="operating_unit_project" required>
        </div>
        <div class="mb-3">
            <label for="pn_code" class="form-label">PN(Code)</label>
            <input type="text" class="form-control" name="pn_code" required>
        </div>
        <div class="mb-3">
            <label for="responsible_person_id" class="form-label">Responsible Person</label>
            <select class="form-control" name="responsible_person_id" required>
                @foreach($personnels as $personnel)
                    <option value="{{ $personnel->id }}">{{ $personnel->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" name="quantity" required>
        </div>
        <div class="mb-3">
            <label for="unit" class="form-label">Unit</label>
            <select class="form-control" name="unit" required>
                <option value="pc">PC</option>
                <option value="unit">Unit</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" required></textarea>
        </div>
        <div class="mb-3">
            <label for="date_acquired" class="form-label">Date Acquired</label>
            <input type="date" class="form-control" name="date_acquired" required>
        </div>
        <div class="mb-3">
            <label for="fund" class="form-label">Fund</label>
            <input type="text" class="form-control" name="fund" required>
        </div>
        <div class="mb-3">
            <label for="ppe_class" class="form-label">PPE Class</label>
            <input type="text" class="form-control" name="ppe_class">
        </div>
        <div class="mb-3">
            <label for="est_useful_life" class="form-label">Estimated Useful Life</label>
            <input type="number" class="form-control" name="est_useful_life">
        </div>
        <div class="mb-3">
            <label for="unit_price" class="form-label">Unit Price</label>
            <input type="number" class="form-control" name="unit_price" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="total_amount" class="form-label">Total Amount</label>
            <input type="number" class="form-control" name="total_amount" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" name="status" required>
                <option value="usable">Usable</option>
                <option value="borrowed">Borrowed</option>
                <option value="repair">Repair</option>
                <option value="missing_not_reported">Missing Not Reported</option>
                <option value="missing_reported_spmo">Missing Reported to SPMO</option>
                <option value="destroyed">Destroyed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Equipment</button>
    </form>
</div>
@endsection
