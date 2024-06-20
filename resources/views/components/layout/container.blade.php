@props([
    'fluid' => false,
])

<div {{ $attributes
    ->cssClass([
        'layer' => 'container',
        'width' => 'w-full max-w-4xl xl:max-w-5xl',
    ])
    ->classMerge([
        'layer',
        'width' => ! $fluid,
    ]);
}}>
    {{ $slot }}
</div>
