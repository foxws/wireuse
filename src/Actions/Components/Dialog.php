<?php

namespace Foxws\WireUse\Actions\Components;

use Closure;
use Filament\Actions\ActionGroup;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Views\Support\Component;
use Illuminate\View\View;

class Dialog extends Component
{
    public function __construct(
        public ActionGroup $actions,
        public Action $action,
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('wireuse::actions.link');
    }
}
