<?php

namespace Foxws\WireUse\Support\Components\Concerns;

trait HasName
{
    public ?string $name = null;

    public function name(?string $name = null): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->value('name');
    }
}
