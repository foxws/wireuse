<?php

namespace Foxws\WireUse\Actions\Components;

use Foxws\WireUse\Views\Support\Component;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;

class Dropdown extends Component
{
    public function __construct(
        public string|Htmlable|null $actions = null,
    ) {
    }

    public function render(): View
    {
        return view('wireuse::actions.dropdown');
    }
}
