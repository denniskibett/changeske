<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PointController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\StateDepartmentController;
use App\Http\Controllers\HomeController;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\NotificationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;


Route::get('/', function () {
    return redirect()->route('points.index');
})->name('home');

Route::get('/', [PointController::class, 'index'])->name('points.index');

Route::get('/points', [PointController::class, 'index'])->name('points.index');
Route::get('/points/create', [PointController::class, 'create'])->name('points.create');
Route::post('/points', [PointController::class, 'store'])->name('points.store');
Route::post('/points/{point}/like', [PointController::class, 'like'])->name('points.like');

//Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::get('register', [RegisteredUserController::class, 'create'])->name('register');

Route::get('/points', [PointController::class, 'index'])->name('points.index');
Route::get('/points/create', [PointController::class, 'create'])->name('points.create');
Route::get('/points/top-points', [PointController::class, 'top_points'])->name('points.top_points');
Route::post('/points', [PointController::class, 'store'])->name('points.store');
Route::post('/points/{point}/like', [PointController::class, 'like'])->name('points.like');


// Get state_departments on choosing ministries
Route::get('/state-departments/{ministry}', function ($ministryId) {
    return App\Models\StateDepartment::where('ministry_id', $ministryId)->get(['id', 'name']);
});

// Get top points
Route::get('/top-points', [PointController::class, 'top_points'])->name('points.top_points');

//Get Point Details
Route::get('/points/{point}', [PointController::class, 'show'])
    ->middleware('auth')
    ->name('points.show');

//Add comments
Route::get('/points/{point}', [PointController::class, 'show'])
    ->name('points.show');

// Update route to handle comments
Route::post('/points/{point}/comments', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');

Auth::routes();

// routes/web.php
Route::get('/', [PointController::class, 'index'])->name('home');
Route::get('/points', [PointController::class, 'index'])->name('points');
Route::get('/points/{point}', [PointController::class, 'show'])->name('points.show');
Route::get('/home', [PointController::class, 'index'])->name('home');
Route::get('/add-point', [PointController::class, 'create'])->name('points.create');
Route::post('/store-point', [PointController::class, 'store'])->name('points.store');
Route::post('/like/{point}', [LikeController::class, 'store'])->name('likes.store');
Route::post('/comment/{point}', [CommentController::class, 'store'])->name('comments.store');
Route::get('/state-departments/{ministryId}', [PointController::class, 'fetchStateDepartments'])->name('state_departments.fetch');

Route::post('/points/{id}/like', [PointController::class, 'like'])->name('points.like');
Route::get('/points/{id}', [PointController::class, 'show'])->name('points.show');
Route::post('/comments/{pointId}', [CommentController::class, 'store'])->name('comments.store');
Route::get('/top-points', [PointController::class, 'topPoints'])->name('top_points');
Route::get('/points', [PointController::class, 'index'])->name('points.index');
