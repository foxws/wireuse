<?php

namespace Foxws\WireUse\Scout;

use Foxws\WireUse\Support\Discover\LivewireStructureScout;
use Livewire\Livewire;

class LivewireScout extends Scout
{
    public function register(): void
    {
        $this->get()->each(fn (array $component) => Livewire::component(...$component));
    }

    protected function getComponentStructures(): LivewireStructureScout
    {
        return LivewireStructureScout::create()
            ->path($this->path)
            ->prefix("livewire-structures-{$this->prefix}");
    }
}
