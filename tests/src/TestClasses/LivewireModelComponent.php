<?php

namespace Foxws\WireUse\Tests\TestClasses;

use Foxws\WireUse\Tests\Models\Post;
use Livewire\Component;

class LivewireModelComponent extends Component
{
    public Post $post;

    public function render()
    {
        return <<<'HTML'
        <div>
            {{-- wow, such great article content here --}}
        </div>
        HTML;
    }
}
