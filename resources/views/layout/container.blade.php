{{ html()
    ->div($slot)
    ->class([
        'container',
        'w-full max-w-4xl xl:max-w-5xl' => ! $fluid,
    ])
}}
