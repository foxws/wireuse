@php
    $wireModelValue = $wireModel() ? $this->getPropertyValue($wireModel()) : null;
    $isActive = $action->isActive() || $wireModelValue === $action->getName();
@endphp

<a
    @if ($wireModel()) wire:click="$set('{{ $wireModel() }}', '{{ $action->getName() }}')" @endif
    {{ $attributes
        ->cssClass([
            'layer' => 'inline-flex shrink-0 cursor-pointer items-center',
            'active' => 'text-primary-400 hover:text-primary-300',
            'inactive' => 'text-secondary hover:text-primary-400',
        ])
        ->classMerge([
            'layer',
            'active' => $isActive,
            'inactive' => ! $isActive,
        ])
        ->merge([
            'wire:navigate' => $action->shouldNavigate(),
            'href' => $action->getUrl(),
            'aria-label' => $action->getLabel(),
            'title' => $action->getLabel(),
        ])
        ->withoutWireModel()
    }}
>
    @if ($slot->isEmpty())
        {{ $action->getLabel() }}
    @else
        {{ $slot }}
    @endif
</a>
