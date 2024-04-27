<a
    @if ($action->hasWireModel())
        wire:click="$set('{{ $action->getWireModel() }}', '{{ $action->getName() }}')"
    @endif

    {{ $attributes
        ->cssClass([
            'layer' => 'inline-flex shrink-0 cursor-pointer items-center',
            'active' => 'text-primary-400 hover:text-primary-300',
            'inactive' => 'text-secondary hover:text-primary-400',
            'label' => 'line-clamp-2',
            'icon' => 'size-5',
        ])
        ->mergeAttributes($action->getBladeAttributes())
        ->classMerge([
            'layer',
            'active' => $action->isActive(),
            'inactive' => ! $action->isActive(),
        ])
        ->merge([
            'wire:navigate' => $action->useNavigate(),
            'href' => $action->getUrl(),
            'aria-label' => $action->getLabel(),
        ])
    }}
>
    @if ($slot->isEmpty())
        <x-wireuse::actions-icon class="{{ $attributes->classFor('icon') }}" :$action />
        <span class="{{ $attributes->classFor('label') }}">{{ $action->getLabel() }}</span>
    @else
        {{ $slot }}
    @endif
</a>
