@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Edit Personnel</h2>
    <form action="{{ route('personnels.update', $personnel->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $personnel->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3">{{ old('description', $personnel->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="working_period" class="form-label">Working Period</label>
            <input type="text" class="form-control" name="working_period" value="{{ old('working_period', $personnel->working_period) }}" required>
        </div>

        <div class="mb-3">
            <label for="designation" class="form-label">Designation</label>
            <input type="text" class="form-control" name="designation" value="{{ old('designation', $personnel->designation) }}" required>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update Personnel</button>
            <a href="{{ route('personnels.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
