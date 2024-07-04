<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Request $request, Point $point)
    {
        $like = Like::where('point_id', $point->id)->where('user_id', Auth::id())->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'point_id' => $point->id,
                'user_id' => Auth::id(),
            ]);
        }

        return redirect()->route('points.index')->with('success', 'Like toggled successfully!');
    }
}
