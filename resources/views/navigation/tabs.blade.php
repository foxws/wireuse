<div {{ $attributes
    ->cssClass([
        'layer' => 'w-full flex shrink-0 cursor-pointer items-center',
        'tab' => 'border-b pb-3',
        'tab-active' => 'border-primary-400 text-primary-400',
        'tab-inactive' => 'border-secondary-400 text-secondary-400',
    ])
    ->classMerge([
        'layer',
    ])
    ->merge([
        'x-data' => '{ active: null }',
        'x-modelable' => 'active',
    ])
}}>
    <nav class="flex items-center px-3 gap-x-5 overflow-x-auto border-b border-secondary-500/50">
        @foreach ($nodes as $action)
            <x-wireuse::actions-link
                :$action
                x-on:click="active = '{{ $action->getName() }}'"
                class="{{ $attributes->classFor('tab') }}"
                class:active="{{ $attributes->classFor('tab-active') }}"
                class:inactive="{{ $attributes->classFor('tab-inactive') }}"
            >
                <x-wireuse::actions-icon
                    :$action
                    active="{{ $this->getPropertyValue($wireModel()) }}"
                    class="size-6 sm:size-7"
                />

                <span class="line-clamp text-sm font-medium">{{ $action->getLabel() }}</span>
            </x-wireuse::actions-link>
        @endforeach
    </nav>

    <span x-text="active"></span>

    {{-- @if ($current?->hasComponent())
        <x-dynamic-component :component="$current->getComponent()" :$action />
    @endif

    @if ($current?->hasLivewire())
        @livewire($current->getLivewire(), ['action' => $current], key($current->getName()))
    @endif --}}
</div>
