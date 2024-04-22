<div {{ $attributes
    ->cssClass([
        'layer' => 'w-full',
        'padding' => 'p-8',
    ])
    ->classMerge()
}}>
    {{ $slot }}
</div>
