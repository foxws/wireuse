@props([
    'id',
    'label' => null,
    'required' => false,
    'hint' => null,
])

<label {{ $attributes
    ->cssClass([
        'layer' => 'flex items-center text-sm font-medium cursor-pointer',
        'error' => 'text-red-500',
        'hint' => 'pt-1 text-red-500',
        'required' => 'px-1 text-primary-400',
    ])
    ->classMerge([
        'layer',
        'error' => $errors->has($id),
    ])
    ->merge([
        'for' => $id,
    ])
}}>
    {{ $slot }}

    {{ $label }}

    @if ($required)
        <span class="{{ $attributes->classFor('required') }}">*</span>
    @endif

    @if ($hint)
        <p class="{{ $attributes->classFor('hint') }}">
            {{ $hint }}
        </p>
    @endif
</label>
