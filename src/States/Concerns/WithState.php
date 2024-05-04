<?php

namespace Foxws\WireUse\States\Concerns;

use Foxws\WireUse\Support\Livewire\StateObjects\State;
use Livewire\Attributes\Reactive;

trait WithState
{
    #[Reactive]
    public State $state;
}
