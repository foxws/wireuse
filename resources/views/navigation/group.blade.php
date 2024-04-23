<nav {{ $attributes
    ->cssClass([
        'layer' => 'flex items-center px-3 gap-5 border-b border-secondary-800/80 overflow-x-auto',
        'tab' => 'text-sm font-medium py-3',
        'active' => 'text-white border-b border-white-600/80',
        'inactive' => 'text-secondary-600',
    ])
    ->classMerge([
        'layer',
    ])
    ->whereDoesntStartWith('wire:model')
}}>
    @foreach ($navigation->items() as $item)
        <x-wireuse::actions-link
            :action="$item"
            wire:click="$set('{{ $wireModel }}', '{{ $item->getName() }}')"
            class="{{ $attributes->classFor('tab') }}"
            class:active="{{ $attributes->classFor('active') }}"
            class:inactive="{{ $attributes->classFor('inactive') }}"
        />
    @endforeach
</nav>
