<?php

namespace Foxws\WireUse\Support\Components\Concerns;

trait HasComponent
{
    public function component(?string $component = null): static
    {
        $this->component = $component;

        return $this;
    }

    public function livewire(?string $livewire = null): static
    {
        $this->livewire = $livewire;

        return $this;
    }

    public function componentAttributes(?array $attributes = null): static
    {
        $this->componentAttributes = $attributes;

        return $this;
    }

    public function getComponent(): ?string
    {
        return $this->value('component');
    }

    public function getLivewireComponent(): ?string
    {
        return $this->value('livewire');
    }

    public function getComponentAttributes(): array
    {
        return $this->value('componentAttributes', []);
    }
}
