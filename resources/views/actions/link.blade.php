<a
    {{ $attributes
        ->cssClass([
            'layer' => 'inline-flex shrink-0 cursor-pointer items-center justify-center',
            'active' => 'text-primary-400 hover:text-primary-300',
            'inactive' => 'text-secondary hover:text-primary-400',
        ])
        ->mergeAttributes($action->getComponentAttributes())
        ->classMerge([
            'layer',
            // 'active' => $action->isActive(),
            // 'inactive' => ! $action->isActive(),
        ])
        ->merge([
            'wire:navigate' => $action->getWireNavigate(),
            'href' => $action->getUrl(),
            'aria-label' => $action->getLabel(),
        ])
    }}
>
    @if ($slot->isEmpty())
        {{ $action->getLabel() }}
    @else
        {{ $slot }}
    @endif
</a>
