<?php

namespace Foxws\WireUse\Views\Concerns;

use Livewire\Attributes\Computed;

trait WithHash
{
    #[Computed]
    public function hash(): string
    {
        return hash('crc32c', serialize($this));
    }

    #[Computed]
    public function classHash(): string
    {
        return hash('crc32c', serialize(static::class));
    }
}
