@props([
    'prepend' => null,
    'append' => null,
    'label' => null,
    'hint' => null,
])

<div {{ $attributes
    ->cssClass([
        'layer' => 'flex flex-col gap-1.5',
        'input' => 'p-3 h-10 w-full text-base bg-secondary-800/90 border-secondary-500/50 focus:border-secondary-500 focus:border-2 focus:ring-0',
        'label' => 'flex items-center',
        'error' => '!border-red-500',
        'hint' => 'py-3 text-xs',
        'message' => 'text-red-500 text-sm',
    ])
    ->classMerge([
        'layer',
    ])
    ->only('class')
}}>
    <label
        class="{{ $attributes->classFor('label') }}"
        for="{{ $attributes->wireKey() }}"
    >
        {{ $label }}
    </label>

    {{ $prepend }}

    <input {{ $attributes
        ->classMerge([
            'input',
            'error' => $errors->has($attributes->wireModel()),
        ])
        ->merge([
            ...['id' => $attributes->wireKey(), 'type' => 'text'],
            ...$attributes->whereStartsWith('wire:model')
        ])
    }} />

    {{ $append }}

    @if ($hint)
        <p class="{{ $attributes->classFor('hint') }}">{{ $hint }}</p>
    @endif

    @error($attributes->wireKey())
        <p class="{{ $attributes->classFor('message') }}">
            {{ $message }}
        </p>
    @enderror
</div>
