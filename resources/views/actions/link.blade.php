<a {{ $attributes
    ->cssClass([
        'layer' => 'inline-flex shrink-0 cursor-pointer items-center justify-center',
        'label' => 'text-inherit',
        'active' => 'text-primary-400 hover:text-primary-300',
        'inactive' => 'text-secondary-400 hover:text-primary-400',
        'icon' => 'size-6 text-secondary-400',
    ])
    ->mergeAttributes($action->getComponentAttributes())
    ->classMerge([
        'layer',
        'active' => $isCurrent(),
        'inactive' => ! $isCurrent(),
    ])
    ->merge([
        'wire:navigate' => $navigate(),
        'href' => $url(),
        'aria-label' => $label(),
    ])
}}>
    @if ($slot->isEmpty())
        <x-wireuse::actions-icon
            :$action
            class:icon="{{ $attributes->classFor('icon') }}"
        />

        <span class="{{ $attributes->classFor('label') }}">
            {{ $label() }}
        </span>
    @else
        {{ $slot }}
    @endif
</a>
