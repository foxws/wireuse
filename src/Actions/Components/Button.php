<?php

namespace Foxws\WireUse\Actions\Components;

use Closure;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Views\Support\Component;
use Illuminate\View\View;

class Button extends Component
{
    public function __construct(
        public Action $action,
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('wireuse::actions.button');
    }

    public function active(): bool
    {
        return $this->action->isActive();
    }

    public function icon(): ?string
    {
        return $this->when($this->active(),
            fn () => $this->action->getActiveIcon(),
            fn () => $this->action->getIcon(),
        );
    }
}
