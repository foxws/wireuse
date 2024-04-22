<div
    x-data="{ open: false }"
    x-ref="dropdown"
    x-on:click="open = ! open"
    x-on:click.outside="open = false"
    x-trap.inert.noscroll="open"
    @keyup.escape.window="open = false"
    {{ $attributes
        ->cssClass([
            'layer' => 'absolute z-50',
        ])
        ->classWithout()
    }}
>
    <div
        x-cloak
        x-show="open"
        {{ $attributes->classFor('layer') }}
    >
        {{ $slot }}
    </div>

    {{ $actions }}
</div>
