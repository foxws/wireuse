<?php

namespace Foxws\WireUse\Support\Components\Concerns;

trait HasLivewire
{
    public function livewire(?string $value = null): static
    {
        $this->wireComponent = $value;

        return $this;
    }

    public function wireModel(?string $value = null, ?string $modifier = null): static
    {
        $this->wireModel = $value;

        $this->wireModifier = $modifier;

        return $this;
    }

    public function wireNavigate(?bool $value = true): static
    {
        $this->wireNavigate = $value;

        return $this;
    }

    public function getLivewire(): ?string
    {
        return $this->value('wireComponent');
    }

    public function getWireModel(): ?string
    {
        return $this->value('wireModel');
    }

    public function getWireModifier(): ?string
    {
        return $this->value('wireModifier');
    }

    public function getWireNavigate(): ?bool
    {
        return $this->value('wireNavigate');
    }

    public function hasLivewire(): bool
    {
        return $this->offsetExists('wireComponent');
    }

    public function hasWireModel(): bool
    {
        return $this->offsetExists('wireModel');
    }

    public function hasWireNavigate(): bool
    {
        return $this->offsetExists('wireNavigate');
    }
}
