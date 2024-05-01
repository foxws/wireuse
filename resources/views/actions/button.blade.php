<button {{ $attributes
    ->cssClass([
        'layer' => 'inline-flex shrink-0 cursor-pointer items-center justify-center',
        'primary' => 'py-1.5 px-3 bg-primary-500 rounded border border-primary-500',
    ])
    ->mergeAttributes($action->getComponentAttributes())
    ->classMerge([
        'layer',
        'primary' => $attributes->get('type') === 'submit',
    ])
    ->merge([
        'wire:model' => $action->getWireModel(),
        'aria-label' => $label(),
    ])
}}>
    @if ($slot->isEmpty())
        {{ $label() }}
    @else
        {{ $slot }}
    @endif
</button>
