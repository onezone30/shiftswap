<?php

namespace App\Enums;

enum Role: string
{
    case Admin    = 'admin';
    case Manager  = 'manager';
    case Employee = 'employee';

    public function label(): string
    {
        return match($this) {
            Role::Admin    => 'Admin',
            Role::Manager  => 'Manager',
            Role::Employee => 'Employee',
        };
    }
}
