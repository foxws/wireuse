@aware([
    'action',
])

@php
    $icon = $action->isActive() ? $action->getIconActive() : $action->getIcon();
@endphp

@if ($action->hasIcon() && $action->hasState())
    <div x-cloak>
        <x-icon
            x-show="! {{ $action->getState() }}"
            :name="$action->getIcon()"
            {{ $attributes }}
        />

        <x-icon
            x-show="{{ $action->getState() }}"
            :name="$action->getIconActive()"
            {{ $attributes }}
        />
    </div>
@elseif ($action->hasIcon())
    <x-icon :name="$icon" {{ $attributes }} />
@endif
