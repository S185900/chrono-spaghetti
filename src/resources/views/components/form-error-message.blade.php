@props(['message'])

@if($message)
    <span {{ $attributes->merge(['class' => 'chrono-error-message']) }}>
        {{ $message }}
    </span>
@endif