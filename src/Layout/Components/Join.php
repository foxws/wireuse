<?php

namespace Foxws\WireUse\Layout\Components;

use Closure;
use Foxws\WireUse\Views\Support\Component;
use Illuminate\View\View;

class Join extends Component
{
    public function __construct(
        public bool $vertical = false,
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('wireuse::layout.join');
    }
}
