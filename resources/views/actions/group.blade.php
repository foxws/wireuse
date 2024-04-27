<div {{ $attributes
    ->cssClass([
        'layer' => 'flex items-center h-full',
        'item' => 'py-3 border-b',
        'active' => 'text-white border-white-500/80',
        'inactive' => 'text-secondary-500 border-transparent',
    ])
    ->withoutClass()
}}>
    <nav class="{{ $attributes->classFor('layer') }}">
        @foreach ($group->items as $action)
            <x-wireuse::actions-link
                :$action
                class="{{ $attributes->classFor('item') }}"
                class:label="{{ $attributes->classFor('label') }}"
                class:icon="{{ $attributes->classFor('icon') }}"
                class:active="{{ $attributes->classFor('active') }}"
                class:inactive="{{ $attributes->classFor('inactive') }}"
            />

            @if ($action?->hasComponent())
                <x-dynamic-component :component="$action->getComponent()" :$action />
            @endif

            @if ($action?->hasLivewire())
                @livewire($action->getLivewire(), ['action' => $action], key($action->getName()))
            @endif
        @endforeach
    </nav>
</div>
