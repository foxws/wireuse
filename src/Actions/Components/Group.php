<?php

namespace Foxws\WireUse\Actions\Components;

use Closure;
use Foxws\WireUse\Actions\Support\ActionGroup;
use Foxws\WireUse\Views\Support\Component;
use Illuminate\View\View;

class Group extends Component
{
    public function __construct(
        public ActionGroup $group,
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('wireuse::actions.group');
    }
}
