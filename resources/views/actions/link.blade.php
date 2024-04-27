@php
    $active = $action->hasActiveState() ? $action->getActive() : $action->isActive();
@endphp

<a
    x-data="{ active: false }"
    x-init="active = {{ $active || 'false' }}"

    @if ($action->getWireModel())
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
            'wire:navigate' => $action->navigable(),
            'href' => $action->getUrl(),
            'aria-label' => $action->getLabel(),
            'title' => $action->getLabel(),
        ])
    }}
>
    @if ($slot->isEmpty())
        @if ($action->hasIcon())
            <x-icon
                x-cloak
                x-show="! active"
                :name="$action->getIcon()"
                class="{{ $attributes->classFor('icon') }}"
            />
        @endif

        @if ($action->hasIconActive())
            <x-icon
                x-cloak
                x-show="active"
                :name="$action->getIconActive()"
                class="{{ $attributes->classFor('icon') }}"
            />
        @endif

        <span class="{{ $attributes->classFor('label') }}">{{ $action->getLabel() }}</span>
    @else
        {{ $slot }}
    @endif
</a>
