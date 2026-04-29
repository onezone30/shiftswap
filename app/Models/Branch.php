<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'address', 'phone', 'email', 'manager_name', 'notes'])]
class Branch extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }
}
