<?php

namespace Foxws\WireUse\Actions\Concerns;

use Illuminate\Support\Collection;

trait HasAttributes
{
    public function attributes(?array $attributes = null): static
    {
        $this->attributes = array_merge($this->attributes, $attributes);

        return $this;
    }

    public function only(...$keys): Collection
    {
        return $this->collect()->only($keys);
    }

    public function except(...$keys): Collection
    {
        return $this->collect()->except($keys);
    }
}
