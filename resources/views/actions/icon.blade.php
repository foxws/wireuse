<div {{ $attributes
    ->cssClass([
        'layer' => 'inline-flex items-center justify-center',
        'icon' => 'size-6 sm:size-7',
    ])
    ->classMerge([
        'layer',
    ])
}}>
    @if ($iconName())
        <x-icon :name="$iconName()" class="{{ $attributes->classFor('icon') }}" />
    @endif
</div>
