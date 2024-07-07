<?php

namespace Foxws\WireUse\Navigation\Components;

use Closure;
use Foxws\WireUse\Views\Support\Component;
use Illuminate\View\View;
use Spatie\Html\Html;

class Input extends Component
{
    public function __construct(
        public ?Html $prepend = null,
        public ?Html $append = null,
        public ?Html $label = null,
        public ?Html $hint = null,
    ) {}

    public function render(): View|Closure|string
    {
        return view('wireuse::forms.input');
    }
}
