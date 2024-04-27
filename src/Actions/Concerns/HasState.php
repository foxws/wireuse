<?php

namespace Foxws\WireUse\Actions\Concerns;

trait HasState
{
    public function active(bool|string|null $active = null): static
    {
        $this->active = $active;

        return $this;
    }

    public function toggle(bool|string|null $toggle = null): static
    {
        $this->toggle = $toggle;

        return $this;
    }

    public function getActive(): mixed
    {
        return $this->value('active');
    }

    public function getToggle(): mixed
    {
        return $this->value('toggle');
    }

    public function hasToggle(): mixed
    {
        return $this->offsetExists('toggle');
    }
}
