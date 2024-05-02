<div {{ $attributes
    ->cssClass([
        'layer' => 'inline-flex items-center justify-center',
        'icon' => 'size-6 sm:size-7',
    ])
    ->classMerge([
        'layer',
    ])
}}>
    @if ($iconName() && filled($action->getState()))
        <x-icon
            x-cloak
            x-show="! {{ $action->getState() }}"
            :name="$iconName()"
            class="{{ $attributes->classFor('icon') }}"
        />

        @if ($hasActiveIcon())
            <x-icon
                x-cloak
                x-show="{{ $action->getState() }}"
                :name="$action->getActiveIcon()"
                class="{{ $attributes->classFor('icon') }}"
            />
        @endif
    @elseif ($iconName())
        <x-icon :name="$iconName()" class="{{ $attributes->classFor('icon') }}" />
    @endif
</div>
