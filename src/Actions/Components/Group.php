<?php

namespace Foxws\WireUse\Actions\Components;

use Closure;
use Foxws\WireUse\Actions\Support\Actions;
use Foxws\WireUse\Views\Support\Component;
use Illuminate\View\View;

class Group extends Component
{
    public function __construct(
        public Actions $group,
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('wireuse::actions.group');
    }
}
