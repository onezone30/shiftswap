@props(['name', 'size' => 'w-9'])

@php
$initials = strtoupper(
    substr($name, 0, 1) .
    (strstr($name, ' ') ? substr(strstr($name, ' '), 1, 1) : '')
);
@endphp

<div class="avatar placeholder shrink-0">
    <div class="bg-primary text-primary-content rounded-full {{ $size }} text-xs font-bold">
        <span>{{ $initials }}</span>
    </div>
</div>
