<?php

namespace Foxws\WireUse\Support\Discover;

use Livewire\Component;
use Spatie\StructureDiscoverer\Discover;

class LivewireStructureScout extends ComponentStructureScout
{
    protected function definition(): Discover
    {
        return Discover::in($this->path)
            ->parallel()
            ->extending(Component::class)
            ->full();
    }
}
