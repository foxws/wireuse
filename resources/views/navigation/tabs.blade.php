<nav {{ $attributes
    ->cssClass([
        'layer' => 'flex items-center overflow-x-auto',
        'tab' => 'text-sm font-medium border-b py-3',
        'active' => 'text-white border-white-600/80',
        'inactive' => 'text-secondary-600 border-transparent',
    ])
    ->classMerge([
        'layer',
    ])
    ->withoutWireModel()
}}>
    current: {{ $navigation->selected()?->getName() }}<br><br>

    @foreach ($navigation->items as $item)
        <a wire:click="$set('tab', '{{ $item->getName() }}')">
            {{ $item->getName() }}
        </a>

        {{-- <x-wireuse::actions-link
            :action="$item"
            wire:model="{{ $navigation->getWireModel() }}"
            class="{{ $attributes->classFor('tab') }}"
            class:active="{{ $attributes->classFor('active') }}"
            class:inactive="{{ $attributes->classFor('inactive') }}"
        /> --}}
    @endforeach
</nav>
