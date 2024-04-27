<?php

namespace Foxws\WireUse\Forms\Components;

use Foxws\WireUse\Views\Support\Component;
use Illuminate\View\View;

class Input extends Component
{
    public function render(): View
    {
        return view('wireuse::forms.input');
    }
}
