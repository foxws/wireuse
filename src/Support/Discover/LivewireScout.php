<?php

namespace Foxws\WireUse\Support\Discover;

use Livewire\Component;
use Spatie\StructureDiscoverer\Discover;

class LivewireScout extends ComponentScout
{
    protected function definition(): Discover
    {
        return Discover::in($this->path)
            ->parallel()
            ->extending(Component::class)
            ->full();
    }
}
