@php
    $current = $navigation->current();
@endphp

<nav {{ $attributes
    ->cssClass([
        'layer' => 'flex items-center overflow-x-auto',
        'tab' => 'py-3 border-b',
        'active' => 'text-white border-white-500/80',
        'inactive' => 'text-secondary-500 border-transparent',
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

    @includeWhen($current?->hasView(), $current->getView(), compact('action'))
</nav>
