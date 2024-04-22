<form {{ $attributes
    ->cssClass([
        'layer' => 'flex flex-col gap-y-6',
    ])
    ->classMerge()
    ->merge([
        'wire:submit' => 'submit',
    ])
}}>
    {{ $slot }}
</form>
