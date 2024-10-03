@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Borrow Equipment</h2>
    <form action="{{ route('equipments.store-borrow') }}" method="POST">
        @csrf
        <input type="hidden" name="equipment_id" value="{{ $equipment->id }}">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="mb-3">
            <label for="office" class="form-label">Office</label>
            <input type="text" class="form-control" name="office" required>
        </div>
        <div class="mb-3">
            <label for="no" class="form-label">Number (NO)</label>
            <input type="text" class="form-control" name="no" required>
        </div>
        <div class="mb-3">
            <label for="date_borrowed" class="form-label">Date Borrowed</label>
            <input type="date" class="form-control" name="date_borrowed" required>
        </div>
        <div class="mb-3">
            <label for="date_returned" class="form-label">Date to be Returned</label>
            <input type="date" class="form-control" name="date_returned" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit Borrow Request</button>
    </form>
</div>
@endsection
