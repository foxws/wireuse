@php
    $current = $this->getPropertyValue($wireModel() ?? $tabState())
@endphp

<nav {{ $attributes
    ->cssClass([
        'layer' => 'flex items-center px-3 gap-x-5 overflow-x-auto border-b border-secondary-500/50',
        'tab' => 'py-3 gap-x-1.5 border-b',
        'tab-icon' => 'size-5 sm:size-6',
        'tab-active' => 'border-primary-400 text-primary-400',
        'tab-inactive' => 'border-secondary-400 text-secondary-400',
    ])
    ->classMerge([
        'layer',
    ])
    ->merge([
        'wire:model.live' => $tabState(),
        'x-data' => '{ active: null }',
        'x-modelable' => 'active',
    ])
}}>
    @foreach ($actions as $action)
        <x-wireuse::actions-link
            :$action
            x-on:click="active = '{{ $action->getName() }}'"
            active="{{ $current }}"
            class="{{ $attributes->classFor('tab') }}"
            class:active="{{ $attributes->classFor('tab-active') }}"
            class:inactive="{{ $attributes->classFor('tab-inactive') }}"
        >
            <x-wireuse::actions-icon
                :$action
                active="{{ $current }}"
                class:icon="{{ $attributes->classFor('tab-icon') }}"
            />

            <span class="line-clamp text-sm font-medium">{{ $action->getLabel() }}</span>
        </x-wireuse::actions-link>
    @endforeach
</nav>
