<?php

namespace Foxws\WireUse\Views\Concerns;

use Illuminate\Support\Str;
use Ramsey\Uuid\UuidInterface;

trait WithLivewire
{
    public function wireKey(): string
    {
        return $this->attributes->get('id', $this->wireModel() ?? (string) $this->uuid());
    }

    public function wireModel(): ?string
    {
        return $this->attributes->whereStartsWith('wire:model')->first();
    }

    public function uuid(): UuidInterface|string
    {
        return once(fn (): UuidInterface => Str::uuid());
    }
}
