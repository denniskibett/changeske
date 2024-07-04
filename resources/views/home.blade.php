@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <h1 class="mb-4">Points</h1>
    
    <!-- Display success message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ministry</th>
                <th>State Department</th>
                <th>User</th>
                <th>Title</th>
                <th>Description</th>
                <th>Likes</th>
                <th>Comments</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($points as $point)
                <tr>
                    <td>{{ $point->id }}</td>
                    <td>{{ $point->ministry->ministry_id }}</td>
                    <td>{{ $point->stateDepartment->state_department_id }}</td>
                    <td>{{ $point->user->user_id }}</td>
                    <td>{{ $point->title }}</td>
                    <td>{{ $point->description }}</td>
                    <td>{{ $point->likes->count() }}</td>
                    <td>{{ $point->comments->count() }}</td>
                    <td>{{ $point->created_at }}</td>
                    <td>{{ $point->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
