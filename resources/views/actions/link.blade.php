@php
    $icon = $action->isCurrent() ? $action->getIconActive() : $action->getIcon();
@endphp

<a
    @if ($action->getWireModel())
        wire:click="$set('{{ $action->getWireModel() }}', '{{ $action->getName() }}')"
    @endif

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
            'wire:navigate' => $action->canNavigate(),
            'href' => $action->getUrl(),
            'aria-label' => $action->getLabel(),
            'title' => $action->getLabel(),
        ])
    }}
>
    @if ($slot->isEmpty())
        @if ($action->getIcon())
            <x-icon :name="$icon" class="{{ $attributes->classFor('icon') }}" />
        @endif

        {{ $action->getLabel() }}
    @else
        {{ $slot }}
    @endif
</a>
