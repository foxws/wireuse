<?php

namespace Foxws\WireUse\Forms\Concerns;

use Foxws\WireUse\Views\Concerns\WithHash;

trait WithSession
{
    use WithHash;

    protected static bool $store = false;

    public function restore(): void
    {
        if (! static::$store || ! $this->hasStore()) {
            return;
        }

        rescue(
            fn () => $this->fill($this->getStore()) && $this->validate(),
            fn () => $this->resetStore(),
        );
    }

    public function store(): void
    {
        if (! static::$store || ! $this->storeWhen()) {
            return;
        }

        // Make sure to not store any invalid data
        $this->validate();

        session()->put($this->storeId(), serialize($this->storeWith()));
    }

    public function forget(): void
    {
        session()->forget($this->storeId());
    }

    protected function getStore(): array
    {
        return unserialize(session()->get($this->storeId(), []));
    }

    protected function hasStore(): bool
    {
        return session()->has($this->storeId());
    }

    protected function storeWhen(): bool
    {
        return true;
    }

    protected function storeWith(): array
    {
        return $this->all();
    }

    protected function storeId(): string
    {
        return $this->classHash();
    }
}
