@php
    $current = $navigation->current();
@endphp

<div {{ $attributes
    ->cssClass([
        'layer' => 'flex items-center h-full',
        'item' => 'py-3 border-b',
        'active' => 'text-white border-white-500/80',
        'inactive' => 'text-secondary-500 border-transparent',
    ])
    ->withoutClass()
}}>
    <nav class="{{ $classFor('layer') }}">
        @foreach ($navigation->items as $action)
            <x-wireuse::actions-link
                :$action
                class="{{ $classFor('item') }}"
                class:active="{{ $classFor('active') }}"
                class:inactive="{{ $classFor('inactive') }}"
                class:icon="{{ $classFor('icon') }}"
            />
        @endforeach
    </nav>

    @if ($current?->hasComponent())
        <x-dynamic-component :component="$current->getComponent()" :$action />
    @endif

    @if ($current?->hasLivewire())
        @livewire($current->getLivewire(), ['action' => $current], key($current->getName()))
    @endif
</div>
