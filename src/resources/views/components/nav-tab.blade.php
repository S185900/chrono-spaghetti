@props(['active' => false, 'label' => '', 'link' => '#'])

<a href="{{ $link }}" {{ $attributes->merge(['class' => 'tab-custom-btn' . ($active ? ' active' : '')]) }}>
    <span>{{ $label }}</span>
</a>