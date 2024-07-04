<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateDepartment extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function points()
    {
        return $this->hasMany(Point::class);
    }
}
