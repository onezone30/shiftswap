@props([
    'size'     => 'text-lg',
    'inverted' => false,
])

<span {{ $attributes->class([$size, 'font-extrabold']) }}>
    <span class="{{ $inverted ? 'text-primary-content' : 'text-primary' }}">Shift</span><span class="text-secondary">Swap</span>
</span>
