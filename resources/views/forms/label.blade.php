<label {{ $attributes
    ->cssClass([
        'layer' => 'flex items-center cursor-pointer',
        'error' => 'text-red-500',
        'hint' => 'pt-1 text-red-500',
        'required' => 'px-1 text-primary-400',
    ])
    ->classMerge([
        'layer',
        'error' => filled($error) || $errors->has($wireKey()),
    ])
}}>
    {{ $slot }}

    @if ($required)
        <span {{ $attributes->classFor('required') }}>*</span>
    @endif

    @if ($hint)
        <p {{ $attributes->classFor('hint') }}>
            {{ $hint }}
        </p>
    @endif
</label>
