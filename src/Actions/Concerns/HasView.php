<?php

namespace Foxws\WireUse\Actions\Concerns;

trait HasView
{
    public function view(?string $view = null): static
    {
        $this->view = $view;

        return $this;
    }

    public function bladeAttributes(?array $attributes = []): static
    {
        $this->bladeAttributes = $attributes;

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

    public function getBladeAttributes(): array
    {
        return $this->value('bladeAttributes', []);
    }

    public function hasBladeAttributes(): bool
    {
        return $this->offsetExists('bladeAttributes');
    }
}
