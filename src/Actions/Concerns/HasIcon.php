<?php

namespace Foxws\WireUse\Actions\Concerns;

trait HasIcon
{
    public function icon(?string $icon = null): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function iconPosition(?string $position = null): static
    {
        $this->iconPosition = $position;

        return $this;
    }

    public function iconActive(?string $icon = null): static
    {
        $this->iconActive = $icon;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->value('icon');
    }

    public function getIconPosition(): ?string
    {
        return $this->value('iconPosition', 'left');
    }

    public function getIconActive(): ?string
    {
        return $this->value('iconActive', $this->getIcon());
    }

    public function isIconPosition(?string $position = null): ?string
    {
        return $this->getIconPosition() === $position;
    }
}
