<div {{ $attributes
    ->cssClass([
        'layer' => 'flex',
        'horizontal' => 'items-center',
        'vertical' => 'flex-col',
    ])
    ->classMerge([
        'layer',
        'horizontal' => ! $vertical,
        'vertical' => $vertical,
    ])
}}>
    {{ $slot }}
</div>
