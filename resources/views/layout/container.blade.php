<div {{ $attributes
    ->cssClass([
        'layer' => 'container mx-auto w-full',
        'padding' => 'px-6',
        'width' => 'max-w-4xl xl:max-w-5xl',
    ])
    ->classMerge([
        'layer',
        'padding',
        'width' => ! $fluid,
    ]);
}}>
    {{ $slot }}
</div>
