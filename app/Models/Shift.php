<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;


#[Fillable(['branch_id', 'position_id', 'user_id', 'shift_date', 'start_time', 'end_time', 'status', 'notes'])]
class Shift extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function swapRequests()
    {
        return $this->hasMany(ShiftSwap::class, 'shift_id');
    }
}
