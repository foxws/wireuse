<?php

namespace Foxws\WireUse\Navigation\Components;

use Foxws\WireUse\Views\Support\Component;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;

class Navbar extends Component
{
    public function __construct(
        public string|Htmlable|null $start = null,
        public string|Htmlable|null $end = null,
    ) {
    }

    public function render(): View
    {
        return view('wireuse::navigation.navbar');
    }
}
