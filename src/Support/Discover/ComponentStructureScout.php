<?php

namespace Foxws\WireUse\Support\Discover;

use Illuminate\View\Component;
use Spatie\StructureDiscoverer\Cache\LaravelDiscoverCacheDriver;
use Spatie\StructureDiscoverer\Discover;
use Spatie\StructureDiscoverer\StructureScout;

class ComponentStructureScout extends StructureScout
{
    public ?string $path = null;

    public ?string $prefix = null;

    public ?string $store = null;

    protected function definition(): Discover
    {
        return Discover::in($this->path)
            ->parallel()
            ->extending(Component::class)
            ->full();
    }

    public function prefix(?string $prefix = null): static
    {
        $this->prefix = trim($prefix, '-');

        return $this;
    }

    public function path(?string $path = null): static
    {
        $this->path = $path;

        return $this;
    }

    public function identifier(): string
    {
        return $this->prefix ?? static::class;
    }

    public function cacheStore(): ?string
    {
        return $this->store ?? config('structure-discoverer.cache.store');
    }

    public function cacheDriver(): LaravelDiscoverCacheDriver
    {
        return new LaravelDiscoverCacheDriver(
            prefix: $this->identifier(),
            store: $this->cacheStore(),
        );
    }
}
