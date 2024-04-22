<div {{ $attributes
    ->cssClass([
        'layer' => 'w-full overflow-auto',
    ])
    ->classMerge()
}}>
    {{ $slot }}
</div>
