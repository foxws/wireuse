@aware([
    'action',
])

<div class="inline-flex">
    @if ($action->hasIcon() && $action->hasActiveState())
        <div x-data x-cloak>
            <x-icon
                x-show="! {{ $action->getActive() }}"
                :name="$action->getIcon()"
                {{ $attributes->class('size-5') }}
            />

            <x-icon
                x-show="{{ $action->getActive() }}"
                :name="$action->getIconActive()"
                {{ $attributes->class('size-5') }}
            />
        </div>
    @elseif ($action->hasIcon())
        <x-icon
            :name="$action->isActive() ? $action->getIconActive() : $action->getIcon()"
            {{ $attributes->class('size-5') }}
        />
    @endif
</div>
