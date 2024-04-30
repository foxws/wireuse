<?php

namespace Foxws\WireUse\Navigation\Components;

use Closure;
use Foxws\WireUse\States\Support\State;
use Foxws\WireUse\Views\Support\Component;
use Illuminate\View\View;

class Tabs extends Component
{
    public function __construct(
        public State $state,
        public array $actions,
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('wireuse::navigation.tabs');
    }

    public function tabState(): ?string
    {
        return implode('.', [$this->state->getPropertyName(), 'tab']);
    }
}
