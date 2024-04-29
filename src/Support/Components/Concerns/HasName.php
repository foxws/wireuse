<?php

namespace Foxws\WireUse\Support\Components\Concerns;

trait HasName
{
    public function name(?string $name = null): static
    {
        $this->name = $name;

        return $this;
    }

    public function label(?string $label = null): static
    {
        $this->label = $label;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->value('name');
    }

    public function getLabel(): ?string
    {
        return $this->value('label', $this->getName());
    }

    public function hasName(): bool
    {
        return $this->offsetExists('icon');
    }

    public function hasLabel(): bool
    {
        return $this->offsetExists('icon');
    }
}
