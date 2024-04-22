<?php

namespace Foxws\WireUse\Actions\Concerns;

trait HasName
{
    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->value('name');
    }
}
