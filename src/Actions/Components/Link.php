<?php

namespace Foxws\WireUse\Actions\Components;

use Closure;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Views\Concerns\WithLayout;
use Foxws\WireUse\Views\Support\Component;
use Illuminate\View\View;

class Link extends Component
{
    use WithLayout;

    public function __construct(
        public Action $action,
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('wireuse::actions.link');
    }

    public function url(): ?string
    {
        if ($this->action->hasRoute()) {
            return $this->action->getRoute();
        }

        return $this->action->getUrl() ?? '#';
    }

    public function active(): bool
    {
        return $this->action->isRoute() || $this->action->isAppUrl();
    }

    public function navigate(): bool
    {
        return $this->action->hasRoute() || $this->action->shouldNavigate();
    }

    public function icon(): ?string
    {
        return $this->when($this->active(),
            fn () => $this->action->getActiveIcon(),
            fn () => $this->action->getIcon(),
        );
    }
}
