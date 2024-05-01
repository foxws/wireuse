@if (flash()->message)
    <div {{ $attributes
        ->cssClass([
            'layer' => 'flex gap-3 w-full',
            'success' => 'bg-primary-500 rounded text-base p-3 text-sm font-medium',
        ])
        ->classMerge([
            'layer',
            'success' => flash()->level === 'success',
        ])
    }}>
        <span>{{ flash()->message }}</span>
    </div>
@endif
