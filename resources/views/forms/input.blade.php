<input {{ $attributes
    ->cssClass([
        'layer' => 'peer w-full focus:border-transparent focus:ring-0',
        'error' => '!border-red-500',
    ])
    ->classMerge([
        'layer',
        'error' => $errors->has($wireModel()),
    ])
    ->merge([
        'wire:key' => $wireKey(),
        'id' => $wireKey(),
        'type' => 'text',
    ])
}}>
