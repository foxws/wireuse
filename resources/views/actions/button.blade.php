<button
    {{ $attributes
        ->cssClass([
            'layer' => 'inline-flex shrink-0 cursor-pointer items-center justify-center',
            'active' => 'text-primary-400 hover:text-primary-300',
            'inactive' => 'text-secondary-400 hover:text-primary-400',
        ])
        ->mergeAttributes($action->getComponentAttributes())
        ->classMerge([
            'layer',
            'active' => $isCurrent(),
            'inactive' => ! $isCurrent(),
        ])
        ->merge([
            'wire:model' => $action->getWireModel(),
            'aria-label' => $action->getLabel(),
        ])
    }}
>
    @if ($slot->isEmpty())
        {{ $action->getLabel() }}
    @else
        {{ $slot }}
    @endif
</button>
