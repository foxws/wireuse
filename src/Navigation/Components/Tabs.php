<?php

namespace Foxws\WireUse\Navigation\Components;

use Closure;
use Foxws\WireUse\Actions\Support\ActionGroup;
use Foxws\WireUse\Views\Support\Component;
use Illuminate\View\View;

class Tabs extends Component
{
    public function __construct(
        public ActionGroup $actions,
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('wireuse::navigation.tabs');
    }
}
