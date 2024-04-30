<?php

namespace Foxws\WireUse\Navigation\Concerns;

use Foxws\WireUse\Actions\Support\Action;
use Livewire\Attributes\Locked;

trait WithTab
{
    #[Locked]
    public ?Action $action = null;

    public ?array $properties = null;
}
