<?php

namespace Foxws\WireUse\Support\Components\Concerns;

trait HasVisibility
{
    public function visible(?bool $visible = true): static
    {
        $this->visible = $visible;

        return $this;
    }

    public function hidden(?bool $hidden = true): static
    {
        $this->hidden = $hidden;

        return $this;
    }

    public function getVisible(): ?bool
    {
        return $this->value('visible');
    }

    public function getHidden(): ?bool
    {
        return $this->value('hidden');
    }
}
