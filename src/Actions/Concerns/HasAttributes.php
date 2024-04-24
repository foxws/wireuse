<?php

namespace Foxws\WireUse\Actions\Concerns;

trait HasAttributes
{
    public function attributes(?array $attributes = null): static
    {
        $this->attributes = array_merge($this->attributes, $attributes);

        return $this;
    }
}
