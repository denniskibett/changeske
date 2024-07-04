<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Point $point)
    {
        $request->validate([
            'point_id' => 'required|exists:points,id',
            'comment' => 'required|string|max:1000',
        ]);

        Comment::create([
            'point_id' => $request->point_id, // Make sure point_id is correctly captured
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return redirect()->route('points.show', $request->point_id)->with('success', 'Comment added successfully!');
    }
}
