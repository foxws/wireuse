<div {{ $attributes
    ->cssClass([
        'layer' => 'container mx-auto w-full',
        'base' => 'px-6 max-w-4xl xl:max-w-5xl',
    ])
    ->classMerge();
}}>
    {{ $slot }}
</div>
