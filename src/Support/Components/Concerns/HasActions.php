<?php

namespace Foxws\WireUse\Support\Components\Concerns;

use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Actions\Support\Actions;

trait HasActions
{
    public function actions(?Actions $actions = null): static
    {
        $this->actions = $actions;

        return $this;
    }

    public function action(?Action $action = null): static
    {
        $this->action = $action;

        return $this;
    }

    public function getActions(): ?Actions
    {
        return $this->value('actions');
    }

    public function hasActions(): bool
    {
        return $this->offsetExists('actions');
    }

    public function getAction(): ?Action
    {
        return $this->value('action');
    }

    public function hasAction(): bool
    {
        return $this->offsetExists('action');
    }
}
