<button {{ $attributes
    ->cssClass([
        'layer' => 'flex shrink-0 cursor-pointer items-center justify-center',
        'label' => 'text-sm',
        'primary' => 'py-1.5 px-3 bg-primary-500 rounded border border-primary-500',
    ])
    ->mergeAttributes($action->getComponentAttributes())
    ->classMerge([
        'layer',
        'primary' => $attributes->get('type') === 'submit',
    ])
    ->merge([
        'type' => 'button',
        'aria-label' => $label(),
    ])
}}>
    @if ($slot->isEmpty())
        <x-wireuse::actions-icon
            :$action
            class:icon="size-6 text-secondary-400"
        />

        <span class="{{ $attributes->classFor('label') }}">
            {{ $label() }}
        </span>
    @else
        {{ $slot }}
    @endif
</button>
