<button {{ $attributes
    ->cssClass([
        'layer' => 'flex shrink-0 cursor-pointer items-center justify-center',
        'label' => 'text-inherit',
        'primary' => 'py-1.5 px-3 bg-primary-500 rounded border border-primary-500',
        'active' => 'text-primary-400 hover:text-primary-300',
        'inactive' => 'text-secondary-400 hover:text-primary-400',
        'icon' => 'size-6 text-secondary-400',
    ])
    ->mergeAttributes($action->getComponentAttributes())
    ->classMerge([
        'layer',
        'primary' => $attributes->get('type') === 'submit',
        'active' => $isCurrent(),
        'inactive' => ! $isCurrent(),
    ])
    ->merge([
        'type' => 'button',
        'aria-label' => $label(),
    ])
}}>
    @if ($slot->isEmpty())
        <x-wireuse::actions-icon
            :$action
            class:icon="{{ $attributes->classFor('icon') }}"
        />

        @if ($action->hasLabel())
            <span class="{{ $attributes->classFor('label') }}">
                {{ $label() }}
            </span>
        @endif
    @else
        {{ $slot }}
    @endif
</button>
