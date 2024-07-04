@extends('layouts.app')

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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($points as $point)
                <tr>
                    <td><a href="{{ route('points.show', $point->id) }}">{{ $point->id }}</a></td>
                    <td>{{ $point->ministry->name }}</td>
                    <td>{{ $point->stateDepartment->name }}</td>
                    <td>{{ $point->user->name }}</td>
                    <td>{{ $point->title }}</td>
                    <td>{{ $point->description }}</td>
                    <td>
                        <form action="{{ route('points.like', $point->id) }}" method="POST">
                            @csrf
                            @if($point->likes->contains('user_id', Auth::id()))
                                <button type="submit" class="btn btn-secondary">Unlike</button>
                            @else
                                <button type="submit" class="btn btn-primary">Like</button>
                            @endif
                        </form>
                        {{ $point->likes->count() }}
                    </td>
                    <td>
                        {{ $point->comments->count() }}
                        <ul>
                            @foreach($point->comments as $comment)
                                <!--<li>{{ $comment->user->name }}: {{ $comment->comment }}</li>-->
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $point->created_at }}</td>
                    <td>{{ $point->updated_at }}</td>
                    <td><a href="{{ route('points.show', $point->id) }}" class="btn btn-info">View</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
