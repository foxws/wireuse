<?php

namespace Foxws\WireUse\Actions\Concerns;

trait HasLivewire
{
    public function wireModel(?string $value = null): static
    {
        $this->wireModel = $value;

        return $this;
    }

    public function wireNavigate(?bool $value = true): static
    {
        $this->wireNavigate = $value;

        return $this;
    }

    public function getWireModel(): ?string
    {
        return $this->value('wireModel');
    }

    public function getWireNavigate(): ?bool
    {
        return $this->value('wireNavigate');
    }
}
