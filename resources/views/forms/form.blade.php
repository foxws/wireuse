<form {{ $attributes
    ->cssClass([
        'layer' => 'grid grid-flow-row auto-rows-min gap-3',
        'actions' => 'flex flex-nowrap items-center gap-x-3 overflow-x-auto'
    ])
    ->classMerge([
        'layer',
    ])
}}>
    {{ $slot }}

    @if ($actions)
        <div {{ $attributes->classFor('actions') }}>
            {{ $actions }}
        </div>
    @endif
</form>
