<?php

namespace Foxws\WireUse\Actions\Concerns;

trait HasIcon
{
    public function icon(string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function activeIcon(string $icon): static
    {
        $this->activeIcon = $icon;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->value('icon');
    }

    public function getActiveIcon(): ?string
    {
        return $this->value('activeIcon', $this->getIcon());
    }
}
