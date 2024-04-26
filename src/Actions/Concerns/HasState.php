<?php

namespace Foxws\WireUse\Actions\Concerns;

trait HasState
{
    public function active(bool|string|null $active = null): static
    {
        $this->active = $active;

        return $this;
    }

    public function getActive(): mixed
    {
        return $this->value('active');
    }
}
