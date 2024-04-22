<?php

namespace Foxws\WireUse\Actions\Concerns;

trait HasName
{
    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function label(string $label): static
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
}
