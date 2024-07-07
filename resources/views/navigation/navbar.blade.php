@props([
    'start' => null,
    'end' => null,
])

<nav {{ $attributes
    ->cssClass([
        'base' => 'flex flex-nowrap items-stretch justify-between leading-none',
        'start' => 'inline-flex w-2/4 items-center justify-start',
        'center' => 'inline-flex shrink-0 items-center',
        'end' => 'inline-flex w-2/4 items-center justify-end',
    ])
    ->classMerge(['base', 'padding'])
}}>
    @if ($start)
        <div {{ $attributes->classFor('start') }}>
            {{ $start }}
        </div>
    @endif

    @if ($slot->hasActualContent())
        <div class="{{ $attributes->classFor('center') }}">
            {{ $slot }}
        </div>
    @endif

    @if ($end)
        <div class="{{ $attributes->classFor('end') }}">
            {{ $end }}
        </div>
    @endif
</nav>
