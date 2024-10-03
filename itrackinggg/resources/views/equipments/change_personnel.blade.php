@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Change Responsible Personnel for Equipment: {{ $equipment->description }}</h2>

    <form action="{{ route('equipments.confirmChangePersonnel', $equipment->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="responsible_person_id" class="form-label">Select Responsible Person</label>
            <select class="form-select" name="responsible_person_id" required>
                @foreach($personnels as $personnel)
                    <option value="{{ $personnel->id }}" {{ $equipment->responsible_person_id == $personnel->id ? 'selected' : '' }}>
                        {{ $personnel->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Confirm Change</button>
    </form>
    
    <a href="{{ route('equipments.index') }}" class="btn btn-secondary mt-3">Back to Equipment List</a>
</div>
@endsection
