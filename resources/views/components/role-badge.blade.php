@props(['role'])

@php
use App\Enums\Role;
$class = match ($role) {
    Role::Admin    => 'badge-error',
    Role::Manager  => 'badge-warning',
    Role::Employee => 'badge-success',
    default        => 'badge-ghost',
};
@endphp

<span class="badge badge-sm {{ $class }}">{{ $role->label() }}</span>
