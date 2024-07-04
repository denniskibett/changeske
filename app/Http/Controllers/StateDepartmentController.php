<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateDepartment extends Model
{
    use HasFactory;

    protected $fillable = ['ministry_id', 'name'];

    public function fetchByMinistry($ministryId)
    {
        $stateDepartments = StateDepartment::where('ministry_id', $ministryId)->get();
        return response()->json($stateDepartments);
    }
}
