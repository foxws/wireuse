<a {{ $attributes
    ->cssClass([
        'layer' => 'inline-flex shrink-0 cursor-pointer items-center justify-center',
        'label' => 'text-inherit',
        'button' => 'py-1.5 px-3 gap-1 border border-primary-500 no-underline',
        'active' => 'text-primary-400 hover:text-primary-300',
        'inactive' => 'text-secondary-400 hover:text-primary-400',
        'icon' => 'size-6 text-secondary-400',
    ])
    ->mergeAttributes($action->getComponentAttributes())
    ->classMerge([
        'layer',
        'button' => $isButton(),
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
        @if ($action->hasIcon())
            <x-wireuse::actions-icon
                :$action
                class:icon="{{ $attributes->classFor('icon') }}"
            />
        @endif

        @if ($action->hasLabel())
            <span class="{{ $attributes->classFor('label') }}">
                {{ $label() }}
            </span>
        @endif
    @else
        {{ $slot }}
    @endif
</a>
