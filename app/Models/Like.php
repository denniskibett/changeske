<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'point_id'];

    public function point()
    {
        return $this->belongsTo(Point::class, 'point_id');
    }
}
