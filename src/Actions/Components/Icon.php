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
        public ?string $active = null,
    ) {}

    public function render(): View|Closure|string
    {
        return view('wireuse::actions.icon');
    }

    public function iconName(): ?string
    {
        if ($this->isCurrent()) {
            return $this->action->getActiveIcon();
        }

        return $this->action->getIcon();
    }

    public function isCurrent(): bool
    {
        if ($this->active === $this->action->getName()) {
            return true;
        }

        return $this->action->routeIs() || $this->action->fullUrlIs();
    }

    public function hasActiveIcon(): bool
    {
        return $this->action->getActiveIcon() !== $this->iconName();
    }
}
