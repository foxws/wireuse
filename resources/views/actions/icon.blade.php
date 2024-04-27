<div>
    @if ($action->hasIcon() && $action->hasActiveState())
        <div x-data x-cloak>
            <x-icon
                x-show="! {{ $action->getActive() }}"
                :name="$action->getIcon()"
                {{ $attributes }}
            />

            <x-icon
                x-show="{{ $action->getActive() }}"
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
