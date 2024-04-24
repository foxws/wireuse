<div {{ $attributes
    ->cssClass([
        'layer' => 'flex items-center gap-3',
    ])
    ->classMerge()
}}>
    @foreach ($group->items as $action)
        @if ($action->hasComponent())
            <x-dynamic-component :component="$action->getComponent()" :$action />
        @endif

        @if ($action->hasLivewire())
            @livewire($action->getLivewire(), compact('action'), key($action->getName()))
        @endif
    @endforeach
</div>
