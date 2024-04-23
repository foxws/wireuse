<?php

namespace Foxws\WireUse\Actions\Concerns;

trait HasLivewire
{
    public function wireModel(?string $model = null): static
    {
        $this->wireModel = $model;

        return $this;
    }

    public function wireNavigate(bool $value = true): static
    {
        $this->wireNavigate = $value;

        return $this;
    }

    public function hasWireModel(): bool
    {
        return $this->offsetExists('wireModel');
    }

    public function getWireModel(): ?string
    {
        return $this->value('wireModel');
    }

    public function shouldNavigate(): bool
    {
        return $this->value('wireNavigate', $this->isAppUrl());
    }
}
