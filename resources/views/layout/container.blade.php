<div {{ $attributes
    ->cssClass([
        'layer' => 'relative mx-auto w-full',
        'width' => 'max-w-4xl xl:max-w-5xl',
    ])
    ->classMerge([
        'layer',
        'width' => ! $fluid,
    ]);
}}>
    {{ $slot }}
</div>
