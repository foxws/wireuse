<?php

namespace Foxws\WireUse\Layout\Components;

use Closure;
use Foxws\WireUse\Views\Support\Component;
use Illuminate\View\View;

class Container extends Component
{
    public function __construct(
        public bool $fluid = false,
    ) {}

    public function render(): View|Closure|string
    {
        return view('wireuse::layout.container');
    }
}
