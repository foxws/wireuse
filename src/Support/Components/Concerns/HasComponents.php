<?php

namespace Foxws\WireUse\Support\Components\Concerns;

trait HasComponents
{
    public function component(?string $component = null): static
    {
        $this->component = $component;

        return $this;
    }

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

    public function getComponent(): ?string
    {
        return $this->value('component');
    }

    public function hasComponent(): bool
    {
        return $this->offsetExists('component');
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
