@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Add a Point</h1>

    <form action="{{ route('points.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ministry">Ministry</label>
            <select id="ministry" name="ministry_id" class="form-control" required>
                <option value="">Select Ministry</option>
                @foreach($ministries as $ministry)
                    <option value="{{ $ministry->id }}">{{ $ministry->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="state_department">State Department</label>
            <select id="state_department" name="state_department_id" class="form-control" required>
                <option value="">Select State Department</option>
            </select>
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
document.getElementById('ministry').addEventListener('change', function () {
    const ministryId = this.value;
    fetch(`/state-departments/${ministryId}`)
        .then(response => response.json())
        .then(data => {
            const stateDepartmentSelect = document.getElementById('state_department');
            stateDepartmentSelect.innerHTML = '<option value="">Select State Department</option>';
            data.forEach(department => {
                const option = document.createElement('option');
                option.value = department.id;
                option.textContent = department.name;
                stateDepartmentSelect.appendChild(option);
            });
        });
});
</script>
@endsection
