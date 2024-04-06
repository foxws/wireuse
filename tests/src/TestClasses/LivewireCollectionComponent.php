<?php

namespace Foxws\WireUse\Tests\TestClasses;

use Illuminate\Support\Collection;
use Livewire\Component;

class LivewireCollectionComponent extends Component
{
    public Collection $posts;

    public function render()
    {
        return <<<'HTML'
        <div>
            {{-- wow, such great articles here --}}
        </div>
        HTML;
    }
}
