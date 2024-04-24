@php
    $icon = $action->isCurrent() ? $action->getIconActive() : $action->getIcon();
@endphp

<button
    {{ $attributes
        ->cssClass([
            'layer' => 'inline-flex shrink-0 cursor-pointer items-center',
            // 'icon' => 'size-5',
        ])
        ->classMerge([
            'layer',
        ])
        ->merge(['class:icon' => 'size-1'])
    }}
>
    @dd($attributes)

    {{-- @dd($action->getBladeAttributes()); --}}

    @if ($slot->isEmpty())
        @if ($action->getIcon())
            <x-icon :name="$icon" class="{{ $attributes->classFor('icon') }}" />
        @endif

        {{ $action->getLabel() }}
    @else
        {{ $slot }}
    @endif
</button>
