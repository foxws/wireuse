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
    @foreach ($navigation->items as $action)
        <x-wireuse::actions-link
            :$action
            class="{{ $attributes->classFor('tab') }}"
            class:active="{{ $attributes->classFor('active') }}"
            class:inactive="{{ $attributes->classFor('inactive') }}"
            wire:model.live="{{ $wireModel() }}"
        />
    @endforeach
</nav>
