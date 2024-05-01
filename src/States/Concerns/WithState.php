<?php

namespace Foxws\WireUse\States\Concerns;

use Foxws\WireUse\Support\Livewire\StateObjects\State;
use Livewire\Attributes\Locked;

trait WithState
{
    #[Locked]
    public State $state;
}
