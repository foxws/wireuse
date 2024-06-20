<?php

namespace Foxws\WireUse\Actions\Components;

use Closure;
use Illuminate\View\View;

class Button extends Link
{
    public function render(): View|Closure|string
    {
        return view('wireuse::actions.button');
    }
}
