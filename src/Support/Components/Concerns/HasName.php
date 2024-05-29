<?php

namespace Foxws\WireUse\Support\Components\Concerns;

trait HasName
{
    public function name(?string $name = null): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->value('name');
    }

    public function hasName(): bool
    {
        return $this->offsetExists('name');
    }
}
