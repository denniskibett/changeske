<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'ministry_id',
        'state_department_id',
        'user_id',
        'title',
        'description',
    ];

    public function ministry()
    {
        return $this->belongsTo(Ministry::class);
    }

    public function stateDepartment()
    {
        return $this->belongsTo(StateDepartment::class, 'state_department_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
