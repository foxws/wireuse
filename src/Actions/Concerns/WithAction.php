<?php

namespace Foxws\WireUse\Actions\Concerns;

use Foxws\WireUse\Actions\Support\Action;
use Livewire\Attributes\Locked;

trait WithAction
{
    #[Locked]
    public Action $action;
}
