@props([
    'prepend' => null,
    'append' => null,
    'label' => null,
    'hint' => null,
    'placeholder' => null,
    'options' => null,
])

<div {{ $attributes
    ->cssClass([
        'layer' => 'flex flex-col gap-1.5 w-full',
        'input' => 'px-3 h-10 w-full text-base bg-secondary-800/90 border-secondary-500/50 focus:border-secondary-500 focus:border-2 focus:ring-0',
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
    @if ($label)
        <label
            class="{{ $attributes->classFor('label') }}"
            for="{{ $attributes->wireKey() }}"
        >
            {{ $label }}
        </label>
    @endif

    <div class="flex flex-row flex-nowrap gap-3 items-center">
        {{ $prepend }}

        <select {{ $attributes
            ->classMerge([
                'input',
                'error' => $errors->has($attributes->wireModel()),
            ])
            ->merge([
                ...['id' => $attributes->wireKey(), 'type' => 'text'],
                ...$attributes->whereStartsWith('wire:model')
            ])
        }}>
            @if ($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif

            @foreach ($options as $option)
                <option value="{{ $option->value }}">{{ $option->name }}</option>
            @endforeach
        </select>

        {{ $append }}
    </div>

    @if ($hint)
        <p class="{{ $attributes->classFor('hint') }}">{{ $hint }}</p>
    @endif

    @error($attributes->wireKey())
        <p class="{{ $attributes->classFor('message') }}">
            {{ $message }}
        </p>
    @enderror
</div>
