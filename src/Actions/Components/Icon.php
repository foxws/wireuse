<?php

namespace Foxws\WireUse\Actions\Components;

use Closure;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Views\Support\Component;
use Illuminate\View\View;

class Icon extends Component
{
    public function __construct(
        public Action $action,
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('wireuse::actions.icon');
    }

    public function iconName(): ?string
    {
        if ($this->action->routeIs() || $this->action->fullUrlIs()) {
            return $this->action->getActiveIcon();
        }

        return $this->action->getIcon();
    }
}
