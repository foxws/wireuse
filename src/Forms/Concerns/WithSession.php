<?php

namespace Foxws\WireUse\Forms\Concerns;

trait WithSession
{
    protected static bool $store = false;

    /**
     * Restore the form data from the session.
     * This should be called in your mount() method.
     */
    public function restore(): void
    {
        if (! $this->useStore() || ! $this->hasStore()) {
            return;
        }

        rescue(
            fn () => $this->fill($this->getStore()) && $this->validate(),
            fn () => $this->forget(),
        );
    }

    /**
     * Stores the form data in the session.
     * This should be called in your updated() method.
     */
    public function store(): void
    {
        if (! $this->useStore() || ! $this->storeWhen()) {
            return;
        }

        // Make sure to not store any invalid data
        $this->validate();

        session()->put($this->storeId(), serialize($this->storeWith()));
    }

    /**
     * Forget the form data from the session.
     * This may be called in your clear() method.
     */
    public function forget(): void
    {
        session()->forget($this->storeId());
    }

    protected function useStore(): bool
    {
        return static::$store;
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
        return $this->useStore();
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
