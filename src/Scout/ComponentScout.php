<?php

namespace Foxws\WireUse\Scout;

use Foxws\WireUse\Support\Discover\ComponentStructureScout;
use Illuminate\Support\Facades\Blade;

class ComponentScout extends Scout
{
    public function register(): void
    {
        $this->get()->each(fn (array $component) => Blade::component(
            class: $component['class'],
            alias: $component['name'],
        ));
    }

    protected function getComponentStructures(): ComponentStructureScout
    {
        return ComponentStructureScout::create()
            ->path($this->path)
            ->prefix("blade-structures-{$this->prefix}");
    }
}
