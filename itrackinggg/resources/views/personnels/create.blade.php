@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Add Personnel</h2>
    <form action="{{ route('personnels.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description"></textarea>
        </div>
        <div class="mb-3">
            <label for="working_period" class="form-label">Working Period</label>
            <input type="text" class="form-control" name="working_period" required>
        </div>
        <div class="mb-3">
            <label for="designation" class="form-label">Designation</label>
            <input type="text" class="form-control" name="designation" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Personnel</button>
    </form>
</div>
@endsection
