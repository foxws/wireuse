@php
    $icon = $action->isCurrent() ? $action->getIconActive() : $action->getIcon();
@endphp

<button
    {{ $attributes
        ->cssClass([
            'layer' => 'inline-flex shrink-0 cursor-pointer items-center',
            'active' => 'text-primary-400 hover:text-primary-300',
            'inactive' => 'text-secondary hover:text-primary-400',
            'icon' => 'size-5',
        ])
        ->mergeAttributes($action->getBladeAttributes())
        ->classMerge([
            'layer',
        ])
    }}
>
    @if ($slot->isEmpty())
        @if ($action->getIcon())
            <x-icon :name="$icon" class="{{ $classFor('icon') }}" />
        @endif

        {{ $action->getLabel() }}
    @else
        {{ $slot }}
    @endif
</button>
