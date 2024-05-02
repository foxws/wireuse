<?php

namespace Foxws\WireUse\Support\Components\Concerns;

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

    public function getActiveIcon(): ?string
    {
        return $this->value('iconActive', $this->getIcon());
    }
}
