<?php

namespace Foxws\WireUse\Actions\Components;

use Closure;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Views\Support\Component;
use Illuminate\View\View;

class Link extends Component
{
    public function __construct(
        public Action $action,
        public ?string $active = null,
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('wireuse::actions.link');
    }

    public function label(): ?string
    {
        return $this->action->getLabel() ?: $this->action->getName();
    }

    public function url(): ?string
    {
        return $this->action->getRoute() ?: $this->action->getUrl();
    }

    public function navigate(): ?string
    {
        if ($this->action->getWireNavigate() === false) {
            return false;
        }

        return $this->action->routeExist() || $this->action->isAppUrl();
    }

    public function isCurrent(): bool
    {
        if ($this->active === $this->action->getName()) {
            return true;
        }

        return $this->action->routeIs() || $this->action->fullUrlIs();
    }
}
