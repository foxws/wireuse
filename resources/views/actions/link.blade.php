<a
    @if ($navigate()) wire:navigate @endif
    {{ $attributes
        ->cssClass([
            'layer' => 'inline-flex shrink-0 cursor-pointer items-center hover:text-primary-400',
            'active' => 'text-primary-400 hover:text-primary-300',
        ])
        ->classMerge([
            'layer',
            'active' => $active(),
        ])
        ->merge([
            'href' => $url(),
            'aria-label' => $action->getLabel(),
            'title' => $action->getLabel(),
        ])
    }}
>
    {{ $slot }}
</a>
