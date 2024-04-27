@aware([
    'action',
])

<div class="inline-flex">
    @if ($action->hasIcon() && $action->hasState())
        <div x-data x-cloak>
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
        <x-icon
            :name="$action->isActive() ? $action->getIconActive() : $action->getIcon()"
            {{ $attributes }}
        />
    @endif
</div>
