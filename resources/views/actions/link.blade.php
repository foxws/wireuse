@php
    $current = $action->getParent()?->current();
@endphp

<a
    @if ($action->getWireModel()) wire:click="$set('{{ $action->getWireModel() }}', '{{ $action->getName() }}')" @endif
    {{ $attributes
        ->cssClass([
            'layer' => 'inline-flex shrink-0 cursor-pointer items-center',
            'active' => 'text-primary-400 hover:text-primary-300',
            'inactive' => 'text-secondary hover:text-primary-400',
            'icon' => 'size-5',
        ])
        ->classMerge([
            'layer',
            'active' => $current?->getName() === $action->getName(),
            'inactive' => $current?->getName() !== $action->getName(),
        ])
        ->merge([
            'wire:navigate' => $action->canNavigate(),
            'href' => $action->getUrl(),
            'aria-label' => $action->getLabel(),
            'title' => $action->getLabel(),
        ])
    }}
>
    @if ($slot->isEmpty())
        @if ($action->getIcon() && $action->isIconPosition('left'))
            <x-icon {{ $attributes->classFor('icon') }} :name="$action->getIcon()" />
        @endif

        {{ $action->getLabel() }}

        @if ($action->getIcon() && $action->isIconPosition('right'))
            <x-icon {{ $attributes->classFor('icon') }} :name="$action->getIcon()" />
        @endif
    @else
        {{ $slot }}
    @endif
</a>
