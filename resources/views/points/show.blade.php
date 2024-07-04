@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $point->title }}</h1>
    <p>{{ $point->description }}</p>
    <p><strong>Ministry:</strong> {{ $point->ministry->name }}</p>
    <p><strong>State Department:</strong> {{ $point->stateDepartment->name }}</p>
    <p><strong>Posted by:</strong> {{ $point->user->name }}</p>

    <!-- Add Comment Form -->
    <form action="{{ route('comments.store', $point->id) }}" method="POST">
        @csrf
        <input type="hidden" name="point_id" value="{{ $point->id }}">
    
        <div class="form-group">
            <label for="comment">Add a Comment</label>
            <textarea id="comment" name="comment" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>

    <!-- Display Success Message -->
    @if (session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    <!-- Comments Section -->
    <h2 class="mt-4">Comments</h2>
    @foreach ($point->comments as $comment)
        <div class="border p-2 mb-2">
            <p><strong>{{ $comment->user->name }}</strong> at {{ $comment->created_at->format('H:i, d-M-y') }}</p>
            <p>{{ $comment->comment }}</p>
        </div>
    @endforeach
</div>
@endsection
