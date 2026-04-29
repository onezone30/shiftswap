<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Role;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int    $id
 * @property string $name
 * @property string $email
 * @property Role   $role
 * @property int    $position_id
 */
#[Fillable(['name', 'email', 'phone', 'password', 'position_id', 'role', 'employment_type', 'hired_at'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $with = ['branches', 'position'];

    public function isAdmin(): bool
    {
        return $this->role === Role::Admin;
    }

    public function isManager(): bool
    {
        return $this->role === Role::Manager;
    }

    public function isEmployee(): bool
    {
        return $this->role === Role::Employee;
    }

    public function hasRole(string|array $roles): bool
    {
        return in_array($this->role->value, (array) $roles);
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }

    public function requestedSwaps()
    {
        return $this->hasMany(ShiftSwap::class, 'requested_by');
    }

    public function receivedSwaps()
    {
        return $this->hasMany(ShiftSwap::class, 'requested_to');
    }

    public function reviewedSwaps()
    {
        return $this->hasMany(ShiftSwap::class, 'reviewed_by');
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'hired_at'          => 'date',
            'password'          => 'hashed',
            'role'              => Role::class,
            'employment_type'   => \App\Enums\EmploymentType::class,
        ];
    }
}
