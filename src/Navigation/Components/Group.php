<?php

namespace Foxws\WireUse\Navigation\Components;

use Closure;
use Foxws\WireUse\Navigation\Support\NavigationGroup;
use Foxws\WireUse\Views\Concerns\WithLayout;
use Foxws\WireUse\Views\Support\Component;
use Illuminate\View\View;

class Group extends Component
{
    use WithLayout;

    public function __construct(
        public NavigationGroup $navigation,
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('wireuse::navigation.group');
    }
}
