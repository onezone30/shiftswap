@props(['role'])

@php
$config = match ($role) {
    'admin'    => ['class' => 'badge-error',   'label' => 'Admin'],
    'manager'  => ['class' => 'badge-warning', 'label' => 'Manager'],
    'employee' => ['class' => 'badge-success', 'label' => 'Employee'],
    default    => ['class' => 'badge-ghost',   'label' => ucfirst($role)],
};
@endphp

<span class="badge badge-sm {{ $config['class'] }}">{{ $config['label'] }}</span>
