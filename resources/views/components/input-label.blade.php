@props(['value'])

<label {{ $attributes->merge(['class' => 'label-text font-medium text-sm text-base-content']) }}>
    {{ $value ?? $slot }}
</label>
