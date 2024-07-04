<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\Ministry;
use App\Models\StateDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PointController extends Controller
{
    public function index()
    {
        $points = Point::with(['ministry', 'stateDepartment', 'user', 'likes', 'comments.user'])->get();
        return view('points.index', compact('points'));
    }

    public function create()
    {
        $ministries = Ministry::all();
        return view('points.create', compact('ministries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ministry_id' => 'required|exists:ministries,id',
            'state_department_id' => 'required|exists:state_departments,id',
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $ministry = Ministry::findOrFail($request->ministry_id);
        $stateDepartment = StateDepartment::findOrFail($request->state_department_id);

        $point = new Point();
        $point->ministry_id = $ministry->id;
        $point->state_department_id = $stateDepartment->id;
        $point->user_id = Auth::id();
        $point->title = $request->title;
        $point->description = $request->description;
        $point->save();

        return redirect()->route('points.index')->with('success', 'Point added successfully!');
    }

    public function top_points()
    {
        $points = Point::join('ministries', 'points.ministry_id', '=', 'ministries.id')
                       ->join('state_departments', 'points.state_department_id', '=', 'state_departments.id')
                       ->with(['user', 'likes', 'comments.user'])
                       ->select('points.*', 'ministries.name as ministry_name', 'state_departments.name as state_department_name')
                       ->withCount('likes')
                       ->orderBy('likes_count', 'desc')
                       ->get();

        return view('top_points', compact('points'));
    }

    public function like($id)
    {
        $point = Point::findOrFail($id);

        if ($point->likes()->where('user_id', Auth::id())->exists()) {
            $point->likes()->where('user_id', Auth::id())->delete();
        } else {
            $point->likes()->create(['user_id' => Auth::id()]);
        }

        return redirect()->route('points.index');
    }

    public function show(Point $point)
    {
        $point->load(['ministry', 'stateDepartment', 'user', 'comments.user']);
        return view('points.show', compact('point'));
    }
}
