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
        <div {{ $classFor('start') }}>
            {{ $start }}
        </div>
    @endif

    @if ($slot->hasActualContent())
        <div {{ $classFor('center') }}>
            {{ $slot }}
        </div>
    @endif

    @if ($end)
        <div {{ $classFor('end') }}>
            {{ $end }}
        </div>
    @endif
</<nav>
