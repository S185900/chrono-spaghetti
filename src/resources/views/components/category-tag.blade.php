@props(['label'])

@props(['label'])
<button {{ $attributes->merge(['class' => 'category-tag active:scale-95']) }}>
    {{ $label }}
</button>