@props([
    'actions',
])

<nav class="my-3 py-3 overflow-x-auto border-t border-secondary-700/50">
    <x-app.layout.container fluid>
        <nav class="flex flex-nowrap items-center gap-x-3">
            @foreach ($actions as $action)
                <x-wireuse::actions-button :$action>
                    <x-wireuse::actions-icon :$action />
                    <span class="text-sm font-medium">{{ $action->getLabel() }}</span>
                </x-wireuse::actions-button>
            @endforeach
        </nav>
    </x-app.layout.container>
</nav>
