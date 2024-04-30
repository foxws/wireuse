<button {{ $attributes
    ->cssClass([
        'layer' => 'inline-flex shrink-0 cursor-pointer items-center justify-center',
    ])
    ->mergeAttributes($action->getComponentAttributes())
    ->classMerge([
        'layer',
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
