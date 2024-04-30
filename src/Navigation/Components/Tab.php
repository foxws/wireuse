<?php

namespace Foxws\WireUse\Navigation\Components;

use Closure;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\States\Support\State;
use Foxws\WireUse\Views\Support\Component;
use Illuminate\View\View;

class Tab extends Component
{
    public function __construct(
        public Action $action,
        public State $state,
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('wireuse::navigation.tab');
    }
}
