<?php

namespace Foxws\WireUse\Actions\Concerns;

trait HasIcon
{
    public function icon(?string $icon = null): static
    {
        $this->icon = $icon;

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

    public function getIconActive(): ?string
    {
        return $this->value('iconActive', $this->getIcon());
    }

    public function hasIcon(): bool
    {
        return $this->offsetExists('icon');
    }

    public function hasIconActive(): bool
    {
        return $this->offsetExists('iconActive');
    }
}
