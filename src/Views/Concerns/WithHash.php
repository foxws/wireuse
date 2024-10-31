<?php

namespace Foxws\WireUse\Views\Concerns;

use Livewire\Attributes\Computed;

trait WithHash
{
    #[Computed]
    public function hash(): string
    {
        return hash('xxh128', serialize($this));
    }

    #[Computed]
    public function classHash(): string
    {
        return hash('xxh128', serialize(static::class));
    }
}
