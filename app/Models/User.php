<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
 * @property string $role
 * @property int    $branch_id
 * @property int    $position_id
 */
#[Fillable(['name', 'email', 'phone', 'password', 'position_id', 'role', 'employment_type', 'hired_at'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_MANAGER = 'manager';
    public const ROLE_EMPLOYEE = 'employee';

    protected $with = ['branches', 'position'];

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isManager(): bool
    {
        return $this->role === self::ROLE_MANAGER;
    }

    public function isEmployee(): bool
    {
        return $this->role === self::ROLE_EMPLOYEE;
    }

    public function hasRole(string|array $roles): bool
    {
        return \in_array($this->role, (array) $roles);
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
            'employment_type'   => \App\Enums\EmploymentType::class,
        ];
    }
}
