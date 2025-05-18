<?php

namespace Foxws\WireUse\Views\Concerns;

use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Ramsey\Uuid\UuidInterface;

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

    #[Computed]
    public function uuid(): UuidInterface|string
    {
        return once(fn (): UuidInterface => Str::uuid());
    }
}
