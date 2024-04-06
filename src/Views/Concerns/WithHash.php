<?php

namespace Foxws\WireUse\Views\Concerns;

trait WithHash
{
    public function hash(): string
    {
        return hash('crc32c', serialize($this));
    }

    public function classHash(): string
    {
        return hash('crc32c', serialize(static::class));
    }
}
