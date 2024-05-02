<?php

namespace Foxws\WireUse\Support\Components\Concerns;

trait HasLabel
{
    public function label(?string $label = null): static
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->value('label');
    }
}
