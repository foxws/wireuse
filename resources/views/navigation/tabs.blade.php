<nav {{ $attributes
    ->cssClass([
        'layer' => 'flex items-center overflow-x-auto',
        'tab' => 'py-3 border-b',
        'active' => 'text-white border-white-600/80',
        'inactive' => 'text-secondary-600 border-transparent',
    ])
    ->classMerge([
        'layer',
    ])
}}>
    @foreach ($navigation->items as $action)
        <x-wireuse::actions-link
            :$action
            class="{{ $attributes->classFor('tab') }}"
            class:active="{{ $attributes->classFor('active') }}"
            class:inactive="{{ $attributes->classFor('inactive') }}"
            class:icon="{{ $attributes->classFor('icon') }}"
        />
    @endforeach
</nav>
