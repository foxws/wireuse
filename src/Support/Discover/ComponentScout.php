<?php

namespace Foxws\WireUse\Support\Discover;

use Illuminate\View\Component;
use Spatie\StructureDiscoverer\Cache\FileDiscoverCacheDriver;
use Spatie\StructureDiscoverer\Discover;
use Spatie\StructureDiscoverer\StructureScout;

class ComponentScout extends StructureScout
{
    public ?string $path = null;

    public ?string $prefix = null;

    protected function definition(): Discover
    {
        return Discover::in($this->path)
            ->parallel()
            ->extending(Component::class)
            ->full();
    }

    public function identifier(): string
    {
        return $this->prefix ?? static::class;
    }

    public function cacheDriver(): FileDiscoverCacheDriver
    {
        return new FileDiscoverCacheDriver(
            $this->cacheDirectory()
        );
    }

    public function prefix(string $prefix): static
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function path(string $path): static
    {
        $this->path = $path;

        return $this;
    }

    protected function cacheDirectory(): string
    {
        return realpath(config('wireuse.cache-path', storage_path('framework/cache')));
    }
}
