@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Edit Equipment</h2>
    <form action="{{ route('equipments.update', $equipment->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="accounting_officer" class="form-label">Accounting Officer</label>
            <input type="text" class="form-control" name="accounting_officer" value="{{ $equipment->accounting_officer }}" required>
        </div>
        
        <div class="mb-3">
            <label for="operating_unit_project" class="form-label">Operating Unit/Project</label>
            <input type="text" class="form-control" name="operating_unit_project" value="{{ $equipment->operating_unit_project }}" required>
        </div>
        
        <div class="mb-3">
            <label for="pn_code" class="form-label">PN(Code)</label>
            <input type="text" class="form-control" name="pn_code" value="{{ $equipment->pn_code }}" required>
        </div>
        
        <div class="mb-3">
            <label for="responsible_person_id" class="form-label">Responsible Person</label>
            <select class="form-control" name="responsible_person_id" required>
                @foreach($personnels as $personnel)
                    <option value="{{ $personnel->id }}" {{ $equipment->responsible_person_id == $personnel->id ? 'selected' : '' }}>
                        {{ $personnel->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" name="quantity" value="{{ $equipment->quantity }}" required>
        </div>
        
        <div class="mb-3">
            <label for="unit" class="form-label">Unit</label>
            <select class="form-control" name="unit" required>
                <option value="pc" {{ $equipment->unit == 'pc' ? 'selected' : '' }}>PC</option>
                <option value="unit" {{ $equipment->unit == 'unit' ? 'selected' : '' }}>Unit</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" required>{{ $equipment->description }}</textarea>
        </div>
        
        <div class="mb-3">
            <label for="date_acquired" class="form-label">Date Acquired</label>
            <input type="date" class="form-control" name="date_acquired" value="{{ $equipment->date_acquired }}" required>
        </div>
        
        <div class="mb-3">
            <label for="fund" class="form-label">Fund</label>
            <input type="text" class="form-control" name="fund" value="{{ $equipment->fund }}" required>
        </div>
        
        <div class="mb-3">
            <label for="ppe_class" class="form-label">PPE Class</label>
            <input type="text" class="form-control" name="ppe_class" value="{{ $equipment->ppe_class }}">
        </div>
        
        <div class="mb-3">
            <label for="est_useful_life" class="form-label">Estimated Useful Life</label>
            <input type="number" class="form-control" name="est_useful_life" value="{{ $equipment->est_useful_life }}">
        </div>
        
        <div class="mb-3">
            <label for="unit_price" class="form-label">Unit Price</label>
            <input type="number" class="form-control" name="unit_price" value="{{ $equipment->unit_price }}" step="0.01" required>
        </div>
        
        <div class="mb-3">
            <label for="total_amount" class="form-label">Total Amount</label>
            <input type="number" class="form-control" name="total_amount" value="{{ $equipment->total_amount }}" step="0.01" required>
        </div>
        
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" name="status" id="status" required>
                <option value="usable" {{ $equipment->status === 'usable' ? 'selected' : '' }}>Usable</option>
                <option value="borrowed" {{ $equipment->status === 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                <option value="repair" {{ $equipment->status === 'repair' ? 'selected' : '' }}>Repair</option>
                <option value="missing_not_reported" {{ $equipment->status === 'missing_not_reported' ? 'selected' : '' }}>Missing Not Reported</option>
                <option value="missing_reported_spmo" {{ $equipment->status === 'missing_reported_spmo' ? 'selected' : '' }}>Missing Reported to SPMO</option>
                <option value="destroyed" {{ $equipment->status === 'destroyed' ? 'selected' : '' }}>Destroyed</option>
            </select>
        </div>

        <!-- Condemn button (only shows if status is 'missing_reported_spmo') -->
        <div id="condemn-container" style="display:none;" class="mb-3">
            <button type="button" class="btn btn-danger" id="condemn-button">Condemn</button>
        </div>

        <button type="submit" class="btn btn-primary">Update Equipment</button>
    </form>

    <!-- Back to Equipment List Button -->
    <div class="mt-4">
        <a href="{{ route('equipments.index') }}" class="btn btn-secondary">Back to Equipment List</a>
    </div>

    <!-- Button to view condemned equipment -->
    <div class="mt-4">
        <a href="{{ route('equipments.condemned') }}" class="btn btn-secondary">View Condemned Equipment</a>
    </div>
</div>

<script>
    // Show/Hide Condemn button based on the status
    document.getElementById('status').addEventListener('change', function() {
        const condemnContainer = document.getElementById('condemn-container');
        if (this.value === 'missing_reported_spmo') {
            condemnContainer.style.display = 'block';
        } else {
            condemnContainer.style.display = 'none';
        }
    });

    // Show the condemn button if the status is preselected as "missing_reported_spmo"
    window.onload = function() {
        if (document.getElementById('status').value === 'missing_reported_spmo') {
            document.getElementById('condemn-container').style.display = 'block';
        }
    }

    // Handle the condemn button click
    document.getElementById('condemn-button').addEventListener('click', function() {
        if (confirm("Are you sure you want to condemn this equipment?")) {
            // Create a form dynamically and submit it
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('equipments.condemn', $equipment->id) }}";
            form.innerHTML = `@csrf @method('PUT')`; // Add CSRF token and method
            document.body.appendChild(form);
            form.submit();
        }
    });
</script>
@endsection
