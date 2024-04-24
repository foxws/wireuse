<?php

namespace Foxws\WireUse\Actions\Concerns;

trait HasView
{
    public function view(?string $view = null): static
    {
        $this->view = $view;

        return $this;
    }

    public function getView(): ?string
    {
        return $this->value('view');
    }

    public function hasView(): bool
    {
        return $this->offsetExists('view');
    }
}
