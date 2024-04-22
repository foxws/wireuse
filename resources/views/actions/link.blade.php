<a
    @if ($navigate()) wire:navigate @endif
    {{ $attributes
        ->cssClass([
            'layer' => 'inline-flex shrink-0 cursor-pointer items-center hover:text-primary-400',
            'active' => 'text-primary-400 hover:text-primary-300',
            'inactive' => 'text-secondary',
        ])
        ->classMerge([
            'layer',
            'active' => $active(),
            'inactive' => ! $active(),
        ])
        ->merge([
            'href' => $url(),
            'aria-label' => $action->getLabel(),
            'title' => $action->getLabel(),
        ])
    }}
>
    @if ($slot->isEmpty())
        {{ $action->getLabel() }}
    @else
        {{ $slot }}
    @endif
</a>
