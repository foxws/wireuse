<button
    {{ $attributes
        ->cssClass([
            'layer' => 'inline-flex shrink-0 cursor-pointer items-center justify-center',
            'active' => 'text-primary-400 hover:text-primary-300',
            'inactive' => 'text-secondary hover:text-primary-400',
        ])
        ->mergeAttributes($action->getBladeAttributes())
        ->classMerge([
            'layer',
            'active' => $action->isActive(),
            'inactive' => ! $action->isActive(),
        ])
        ->merge([
            'x-data' => $action->hasState(),
            'aria-label' => $action->getLabel(),
            'type' => 'button',
        ])
    }}
>
    @if ($slot->isEmpty())
        {{ $action->getLabel() }}
    @else
        {{ $slot }}
    @endif
</button>
