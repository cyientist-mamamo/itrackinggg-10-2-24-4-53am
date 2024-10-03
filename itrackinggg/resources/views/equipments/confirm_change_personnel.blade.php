@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Confirm Change of Responsible Personnel</h2>
    <p>Old Responsible Person: {{ $oldPersonnel->name }}</p>
    <p>New Responsible Person: {{ $newPersonnel->name }}</p>
    <p>Date Changed: {{ now()->format('Y-m-d H:i:s') }}</p>
    <p><strong>Print before updating the responsible person.</strong></p>

    <form action="{{ route('equipments.updatePersonnel', $equipment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="responsible_person_id" value="{{ $newPersonnel->id }}">
        <button type="submit" class="btn btn-primary">Confirm Update</button>
        <a href="{{ route('equipments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
