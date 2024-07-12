<?php

namespace Foxws\WireUse\Tests\TestClasses;

use Illuminate\View\Component;

class BladeComponent extends Component
{
    public function render(): string
    {
        return <<<'blade'
        {{ html()->div()->class('text-center')->open() }}
            {{-- wow, such great article content here --}}
        {{ html()->div()->close() }}
        blade;
    }
}
