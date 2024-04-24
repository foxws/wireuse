<div
    x-data="{ open: false }"
    x-ref="dropdown"
    x-on:click="open = ! open"
    x-on:click.outside="open = false"
    x-trap.inert.noscroll="open"
    @keyup.escape.window="open = false"

    {{ $attributes
        ->cssClass([
            'layer' => 'inline-flex shrink-0 cursor-pointer items-center',
            'active' => 'text-primary-400 hover:text-primary-300',
            'inactive' => 'text-secondary hover:text-primary-400',
            'icon' => 'size-5',
        ])
        ->classMerge([
            'layer',
            'active' => $action->isCurrent(),
            'inactive' => ! $action->isCurrent(),
        ])
        ->merge([
            'aria-label' => $action->getLabel(),
            'title' => $action->getLabel(),
        ])
    }}
>
    @if ($slot->isEmpty())

    @else
        {{ $slot }}
    @endif



    <button @click="open = ! open">Toggle Modal</button>

    @teleport('body')
        <div x-show="open">
            Modal contents...
        </div>
    @endteleport
</div>
