<?php

namespace Foxws\WireUse\Support\Components\Concerns;

trait HasComponent
{
    public function component(?string $component = null): static
    {
        $this->component = $component;

        return $this;
    }

    public function componentAttributes(?array $attributes = null): static
    {
        $this->componentAttributes = $attributes;

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

    public function getComponentAttributes(): array
    {
        return $this->value('componentAttributes', []);
    }
}
