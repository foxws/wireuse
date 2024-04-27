<nav {{ $attributes
    ->cssClass([
        'base' => 'flex flex-nowrap items-center justify-between leading-none',
        'padding' => 'py-6',
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
</<nav>
