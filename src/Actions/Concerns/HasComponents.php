<?php

namespace Foxws\WireUse\Actions\Concerns;

trait HasComponents
{
    public function component(?string $component = null): static
    {
        $this->component = $component;

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
}
