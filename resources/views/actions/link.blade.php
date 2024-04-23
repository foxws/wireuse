<a
    @if ($action->hasWireModel()) wire:click="$set('{{ $action->getWireModel() }}', '{{ $action->getName() }}')" @endif
    {{ $attributes
        ->cssClass([
            'layer' => 'inline-flex shrink-0 cursor-pointer items-center',
            'active' => 'text-primary-400 hover:text-primary-300',
            'inactive' => 'text-secondary hover:text-primary-400',
        ])
        ->classMerge([
            'layer',
            'active' => $action->getActive(),
            'inactive' => ! $action->getActive(),
        ])
        ->merge([
            'wire:navigate' => $action->getWireNavigate(),
            'href' => $action->getUrl(),
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
